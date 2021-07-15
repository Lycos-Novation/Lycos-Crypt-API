![whatisthis](https://img.shields.io/badge/Lycos--Novation's-Crypt%20and%20compare%20API-brightgreen)
[![chat](https://img.shields.io/discord/627946609896062986?label=Discord)](https://discord.gg/KWjptxF)

# Lycos-API-Crypt

### Page pour les requêtes : _https://lycos-novation.fr/preprod/chiffrer/index.php_  
Vous pouvez tester a la main simplement avec _https://lycos-novation.fr/preprod/chiffrer/form.html_  
##    Comment chiffrer mon texte ?  

Vous devez faire une requête POST en indiquant les champs suivants :  
_action_ : crypt  
_plain_ : {texte à chiffrer}  

Le script vous renverra ensuite un JSON avec un hash.
#### Exemple:
Requête POST : `{"action":"crypt", "plain":"lycos"}`  
Réponse : `{"hash":"lmOGm1LYXh4XTlDsCrzIDClnS0+rBNZlR8XOsIq1pg6sJEKXXieT\/aCSoB+jDBEPECkdUi1C5jFZxD3N4tQkQA=="}`




##  	Comment comparer mon texte avec un hash ?

Vous devez faire une requête POST en indiquant les champs suivants :  
_action_ : compare / crypt  
_hash_ : hash (En cas de compare)  
_plain_ : texte brut (En cas de compare / crypt  

Le script vous renverra ensuite un JSON indiquant si les 2 éléments sont liés ou pas.
#### Exemple:  
Requête POST : `{"action":"compare", "plain":"lycos", "hash":"lmOGm1LYXh4XTlDsCrzIDClnS0+rBNZlR8XOsIq1pg6sJEKXXieT\/aCSoB+jDBEPECkdUi1C5jFZxD3N4tQkQA=="}`  
Réponse : `{"corresponds":true}`

##### Autre exemple : 
Requête POST : `{"action":"compare", "plain":"Lycos", "hash":"lmOGm1LYXh4XTlDsCrzIDClnS0+rBNZlR8XOsIq1pg6sJEKXXieT\/aCSoB+jDBEPECkdUi1C5jFZxD3N4tQkQA=="}`  
Réponse : `{"corresponds":false}`
