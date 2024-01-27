from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from fake_useragent import UserAgent
import datetime
import time

# Spécifiez le chemin vers le binaire Chrome (installation portable)
chrome_binary_path = r'C:\Users\Gregoire\Downloads\PronostatV0.3\chrome-win64\chrome.exe'

# Options pour le navigateur Chrome
options = webdriver.ChromeOptions()
options.binary_location = chrome_binary_path

# Création d'un objet UserAgent pour générer des User-Agents aléatoires
ua = UserAgent()
options.add_argument(f"user-agent={ua.random}")

# Initialisez le WebDriver Chrome en utilisant les options
driver = webdriver.Chrome(options=options)

# Définir la variable email et le mot de passe
email = "gerard.tamere"
password = "password"
url2 = 'https://your_lycee/pronote/eleve.html'

# Chemin vers le fichier exécutable de ChromeDriver
chrome_driver_path = '../files/chromedriver.exe'

# Création de l'objet Service avec le chemin du fichier ChromeDriver et les options
service = webdriver.chrome.service.Service(chrome_driver_path)
driver = webdriver.Chrome(service=service, options=options)

# URL du site Web à ouvrir
url = 'https://ent.iledefrance.fr/auth/login#/'

# Ouvrir le site Web dans le navigateur
driver.get(url)

# Attente pour la saisie des identifiants
time.sleep(10)

# Rechercher le champ de saisie de l'email et le remplir
email_field = driver.find_element(By.NAME, 'email')
email_field.send_keys(email)

# Rechercher le champ de saisie du mot de passe et le remplir
password_field = driver.find_element(By.NAME, 'password')
password_field.send_keys(password)

# Appuyer sur la touche Entrée pour soumettre le formulaire
password_field.send_keys(Keys.RETURN)

# Attente implicite
driver.implicitly_wait(10)

# URL de la page à partir de laquelle vous souhaitez extraire des informations

# Ouvrir le site Web dans le navigateur
driver.get(url2)

# Ajoutez des délais pour simuler un comportement humain
time.sleep(5)  # Attendez 5 secondes

# Récupérer les informations spécifiques de l'élément avec l'ID "id_79"
id_79_element = driver.find_element(By.ID, "id_73")
id_79_info = id_79_element.text
photo = driver.find_element_by_class_name("liste-cours m-top-l")

# Capture d'écran
photo.screenshot(f'../export/{email}.png')


# Fermeture du navigateur
driver.quit()

# Créer le nom de fichier basé sur la variable email
filename = f"../export/{email}.txt"

# Écrire les résultats dans le fichier, à la ligne
with open(filename, "w") as file:
    file.write(id_79_info + "\n\n")

print(f"Les résultats ont été enregistrés dans le fichier {filename}")

# Ouvre le fichier en mode lecture
with open(f'../export/{email}.txt', 'r') as file:
    # Lit le contenu du fichier
    content = file.read()

# Remplace "hier" par "le 0 sept"
content_modifie = content.replace('Hier', 'le 0 sept.')

# Ouvre le fichier en mode écriture pour sauvegarder le contenu modifié
with open(f'../export/{email}.txt', 'w') as file:
    file.write(content_modifie)

print("Le remplacement a été effectué avec succès.")

# Fonction pour convertir la date de l'abréviation en format numérique
def convert_date(date_str):
    months = {
        "janv.": "01", "févr.": "02", "mars": "03", "avr.": "04",
        "mai": "05", "juin": "06", "juil.": "07", "août": "08",
        "sept.": "09", "oct.": "10", "nov.": "11", "déc.": "12"
    }

    date_parts = date_str.split()
    day = date_parts[1]
    month = months[date_parts[2]]
    return f"{day}/{month}"

# Fonction pour calculer la note totale
def calculate_total(note_str):
    note_parts = note_str.split('/')
    if len(note_parts) == 2:
        try:
            note = float(note_parts[0].replace(",", ".")) * 20
            total = note / float(note_parts[1])
            return round(total, 2)
        except (ValueError, ZeroDivisionError):
            return None
    return None

# Ouvrir le fichier en mode lecture
with open(f"../export/{email}.txt", "r") as file:
    lines = file.readlines()

# Initialisation des listes pour matières, dates et notes
matieres = []
dates = []
notes = []

# Remplacement de "hier" par "le 0 sept"
for i in range(len(lines)):
    lines[i] = lines[i].replace("hier", "le 0 sept")

# Parcourir les lignes du fichier
for line in lines:
    line = line.strip()  # Supprimer les espaces en début et fin de ligne

    # Identifier la matière (texte en majuscules)
    if line.isupper():
        matieres.append(line)
    # Identifier la date (ligne commence par "le")
    elif line.startswith("le"):
        # Conversion de l'abréviation de date
        date = convert_date(line)
        dates.append(date)
    # Identifier la note
    else:
        total = calculate_total(line)
        if total is not None:
            notes.append(total)
        else:
            notes.append(line)

# Calcul de la moyenne
total_notes = sum(note for note in notes if isinstance(note, float))
num_notes = len([note for note in notes if isinstance(note, float)])

if num_notes > 0:
    moyenne = round(total_notes / num_notes, 2)
else:
    moyenne = 0

# Écriture de la moyenne dans le fichier "exemple.txt"
with open("../friendlist/exemple.txt", "a") as friendlist_file:
    friendlist_file.write(f"{email};{moyenne}\n")

# Créer un nouveau fichier trié
with open(f"../export/{email}-clear.txt", "w") as sorted_file:
    previous_entry = None  # Garder une trace de l'entrée précédente
    for matiere, date, note in zip(matieres, dates, notes):
        sorted_file.write(f"matieres : {matiere}\n")
        sorted_file.write(f"date : {date}\n")
        sorted_file.write(f"note : {note}\n\n")
