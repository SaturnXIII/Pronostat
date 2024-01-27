import subprocess
import shutil

# Informations sur le nouvel utilisateur
new_username = input("Entrez le nom d'utilisateur : ")
new_user_password = input("Entrez le mot de passe de l'utilisateur : ")
url = input("Entrez l'URL de l'établissement : ")

# Copier le fichier Mastok.py et le renommer
shutil.copy("script/Mastok.py", f"script/{new_username}.py")

# Modifier le fichier
with open(f"script/{new_username}.py", "r") as file:
    data = file.read()
    data = data.replace("gerard.tamere", new_username)
    data = data.replace("password", new_user_password)
    data = data.replace("https://your_lycee/pronote/eleve.html", url)

with open(f"script/{new_username}.py", "w") as file:
    file.write(data)

# Copier et modifier le fichier graph.txt
shutil.copy("files/graph.txt", f"newgraph/{new_username}.php")
with open(f"newgraph/{new_username}.php", "r") as file:
    data = file.read()
    data = data.replace("user.name", new_username)

with open(f"newgraph/{new_username}.php", "w") as file:
    file.write(data)

# Modifier le fichier start.ps1 sur votre ordinateur
with open("start.ps1", "a") as file:
    file.write("Start-Sleep -Seconds 15 \n")
    file.write(f"python3 {new_username}.py\n")
    file.write(f"echo Scraping of {new_username} OK \n")

# Modifier un fichier sur l'établissement
# Ajoutez ici le code pour modifier un fichier sur l'établissement, si nécessaire.

# Modifier le fichier redirect.txt en tant qu'utilisateur root
# Ajoutez ici le code pour modifier le fichier redirect.txt en tant qu'utilisateur root.

print("Opérations terminées.")
