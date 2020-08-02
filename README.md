# Boulangerie

## Pré-requis : 
- PHP 7.4
- COMPOSER (https://getcomposer.org/)
- NODE 10.x.x
- NPM 6.x.x (https://nodejs.org/en/download/)
- YARN 1.x.x (https://yarnpkg.com/lang/en/docs/install/)
- La tables sont en INNODB
- Nom de la bdd boulangerie

## Installation du projet : 
- git clone ou depuis un tag recuperer le fichier tar.gz
- `composer install` (pour installer le fichier vendor)

# A voir pour PHP-CS-FIXER

## PHP-CS-FIXER
#### Commandes de base :
Tester les fichiers du repertoire « src » vis à vis des normes PSR-Symfony sans faire les modifications de code (uniquement sortie du message).

`php php-cs-fixer-v2.phar fix --dry-run --rules=@Symfony src` 

Tester les fichiers du repertoire « src » vis à vis des normes PSR-Symfony et corriger les fichiers à la volée.

`php php-cs-fixer-v2.phar fix --rules=@Symfony src`

Une fois le projet installé, verifier le fonctionnennent de php-cs-fixer-v2.phar.
S'il fonctionne correctement, intégrer le fichier nommé « pre-commit » suivant dans .git/hooks

```
#!/usr/bin/env bash
 
 echo "php-cs-fixer pre commit hook start"
 
 PHP_CS_FIXER="php-cs-fixer-v2.phar"
 HAS_PHP_CS_FIXER=false
 #MESSAGE=""
 
 if [ -x vendor/bin/php-cs-fixer ]; then
     HAS_PHP_CS_FIXER=true
 fi
 
 if $HAS_PHP_CS_FIXER; then
 	MESSAGE=$(php php-cs-fixer-v2.phar fix --dry-run --rules=@Symfony src)
 	echo "${MESSAGE}"
 else
     MESSAGE="Please install php-cs-fixer, e.g.:";
 	echo "$MESSAGE";
     MESSAGE="  composer require friendsofphp/php-cs-fixer";
 	echo "$MESSAGE";
 	echo "php-cs-fixer pre commit hook finish"
 	exit 1
 fi
 echo "---------";
 #echo "$MESSAGE";
 #if [ ! -z "$MESSAGE" ]; then
 if [[ $MESSAGE == *"1)"* ]]; then
 	echo "Commit annulé : veuillez lancer la commande \"php php-cs-fixer-v2.phar fix --rules=@Symfony src\" puis refaire votre commit.";
 	echo "php-cs-fixer pre commit hook finish"
 	exit 1
 fi
 echo "Pas de fichiers à corriger par php-cs-fixer"
 echo "php-cs-fixer pre commit hook finish"
 
 if git rev-parse --verify HEAD >/dev/null 2>&1
 then
 	against=HEAD
 else
 	# Initial commit: diff against an empty tree object
 	against=4b825dc642cb6eb9a060e54bf8d69288fbee4904
 fi
 
 # If you want to allow non-ASCII filenames set this variable to true.
 allownonascii=$(git config --bool hooks.allownonascii)
 
 # Redirect output to stderr.
 exec 1>&2
 
 # Cross platform projects tend to avoid non-ASCII filenames; prevent
 # them from being added to the repository. We exploit the fact that the
 # printable range starts at the space character and ends with tilde.
 if [ "$allownonascii" != "true" ] &&
 	# Note that the use of brackets around a tr range is ok here, (it's
 	# even required, for portability to Solaris 10's /usr/bin/tr), since
 	# the square bracket bytes happen to fall in the designated range.
 	test $(git diff --cached --name-only --diff-filter=A -z $against |
 	  LC_ALL=C tr -d '[ -~]\0' | wc -c) != 0
 then
 	cat <<\EOF
 Error: Attempt to add a non-ASCII file name.
 
 This can cause problems if you want to work with people on other platforms.
 
 To be portable it is advisable to rename the file.
 
 If you know what you are doing you can disable this check using:
 
   git config hooks.allownonascii true
 EOF
 	exit 1
 fi
 ```
