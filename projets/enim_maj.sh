# Script montée de version instance $instance
# Copie ogrh.war via ftp dans $rep_war
# Connexion au serveur SSH frontal
# sudo -su root
# Execution du script avec comme parametre n° de version

# variables
# nom instance
instance=enim.winpaieplusrh.fr
# base de données
bdd=winpprh
# user postres
user=winpprh_prd
# mdp user postgres
mdp="VJ4rMf639H6ugz"
# répertoire instance
path=/var/lib/tomcat/instances
# nom service tomcat
tomcat_service=tomcat8-enim
# répertoire des BibliActes/
datas=/var/lib/tomcat/instances/enim.winpaieplusrh.fr/Datas/Wpprh
# adresse ip base de données
bdd_ip=10.100.119.104
# user serveur de base de données
bdd_user=admin_ceg
# url
url=https://enim.winpaieplusrh.fr/ogrh/
# fichier war
war=ogrh.war
# mail host
host=10.20.164.5
# mail from
from=admin@enim.wpprh.fr
# répertoire logs
logs=/var/lib/tomcat/instances/enim.winpaieplusrh.fr/logs/logs-ogrh/
# base de donnée sauvegardée
bdd_save=wpprh_enim.sql
# répertoire war
rep_war=/var/lib/tomcat/instances/Downloads/$1

usage () {
        cat <<eof
Usage: <N° version format v0_0_0_0>
eof
}

usage
if [ -z $1 ]
then
	echo "Il manque le paramètre de version format v0_0_0_0"
exit
elif [ ! -e $rep_war/$war ]
then
	echo "Le fichier .war n'est pas présent"
exit
else
	echo "Le fichier est présent, démarrage de la montée de version"
	echo "Arret du tomcat"
systemctl stop $tomcat_service
fi

echo "Voulez vous faire une sauvegarde de la BDD ? [O/N]"
read mot
if [ "$mot" = "O" ] || [ "$mot" = "o" ]
then
ssh $bdd_user@$bdd_ip <<eof
mkdir $instance_$1
cd $instance_$1
export PGPASSWORD="$mdp"; pg_dump -U $user -h localhost $bdd > $bdd_save
if [ ! -e $bdd_save ]
then
	echo "Erreur : echec pg_dump"
exit
fi
eof
	echo "La sauvegarde de la BDD a été effectuée"
else
	echo "La sauvegarde de la BDD n'a pas été effectuée"
fi

cd $path
echo "Voulez vous faire une sauvegarde applicative ? [O/N]"
read mot
if [ "$mot" = "O" ] || [ "$mot" = "o" ]
then
	rm -r $instance.sav
	cp -R -p $instance $instance.sav
	if [ ! -e $instance.sav ]
	then
		echo "Erreur : echec sauvegarde application"
	exit
	fi
	echo "La sauvegarde applicative a été effectuée."
else
	echo "La sauvegarde applicative n'a pas été effectuée"
fi
	
mkdir $instance.sav/nouveau.sav
cd $instance
rm -r webapps/ogrh
rm logs/*.*
rm logs/logs-ogrh/*.*
rm logs/logs-ogrh/archives/*.*
rm work/*.*
rm temp/*.*

cp $rep_war/$war webapps/
cd webapps/
chown tomcat8 $war
chgrp tomcat8 $war
chmod 775 $war

systemctl start $tomcat_service

echo "Le déploiement est-il fini ? [O/N]"
read mot
while
[ "$mot" != "O" ] && [ "$mot" != "o" ]
do
echo "Voulez-vous continuer ? [O/N]"
read mot
done
echo "Continue"

systemctl stop $tomcat_service

cat <<EOF > ogrh/WEB-INF/classes/config/contexts/database.properties
#  = oracle ou vide pour postgresql
grails.env=
# nom de la base pour postgresql et SID pour oracle
connection_ogrh_export_Database=$bdd
connection_ogrh_export_Login=$user
connection_ogrh_export_Password=$mdp
# 1521 pour oracle
connection_ogrh_export_Port=5432
connection_ogrh_export_Schema=public
connection_ogrh_export_Server=$bdd_ip

#nom de la base de données pour la reprise
connection_r2d2_export_Database=r2d2
connection_r2d2_export_Login=r2d2
connection_r2d2_export_Password=r2d2
# 1521 pour oracle
connection_r2d2_export_Port=5432
connection_r2d2_export_Schema=public
connection_r2d2_export_Server=localhost
EOF

sed -i "s|String LOG_PATH = \".*\"|String LOG_PATH = \"$logs\"|" ogrh/WEB-INF/classes/logback.groovy
sed -i "s|String LOG_ARCHIVE = \".*\"|String LOG_ARCHIVE = \"${LOG_PATH}archives/\"|" ogrh/WEB-INF/classes/logback.groovy
sed -i "/productionArrete:/,+1 s|models: \".*\"|models: \"$datas/BibliActes/Modeles\"|;" ogrh/WEB-INF/classes/application.yml
sed -i "/parramGeneral:/,+1 s|uploadpath: \".*\"|uploadpath: \"$datas/BibliActes/ParramGeneraux\"|;" ogrh/WEB-INF/classes/application.yml
sed -i "/piecesJointes:/,+1 s|uploadpath: \".*\"|uploadpath: \"$datas/Demandes/pj\"|;" ogrh/WEB-INF/classes/application.yml
sed -i "/mail:/,+1 s|host: Aliassmtp.domain.com|host: $host|;" ogrh/WEB-INF/classes/application.yml
sed -i "/default:/,+1 s|from: adminsecu@wpprh.fr|from: $from|;" ogrh/WEB-INF/classes/application.yml

mv $war ../../$instance.sav/nouveau.sav
cp ogrh/WEB-INF/classes/application.yml ../../$instance.sav/nouveau.sav
cp ogrh/WEB-INF/classes/logback.groovy ../../$instance.sav/nouveau.sav
cp ogrh/WEB-INF/classes/config/contexts/database.properties ../../$instance.sav/nouveau.sav
cd ../../

if [ -e $instance.sav/nouveau.sav/$war ] && [ -e $instance.sav/nouveau.sav/application.yml ] && [ -e $instance.sav/nouveau.sav/logback.groovy ] && [ -e $instance.sav/nouveau.sav/database.properties ]
then
	echo "Les fichiers sont copiés dans le répertoire $instance/nouveau.sav"
else
	echo "Les fichiers n'ont pas été copiés dans le répertoire $instance/nouveau.sav"
fi

if [ ! -e $instance/webapps/$war ]
then
systemctl start $tomcat_service
else
	echo "Le fichier $war est toujours présent, risque de problème paramétrage (application.yml, logback.groovy, database.properties)"
fi
systemctl status $tomcat_service
	echo "Pour tester l'application, aller sur $url"
