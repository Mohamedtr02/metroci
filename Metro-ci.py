import tkinter as tk
from datetime import datetime, timedelta
import requests
from PIL import Image, ImageTk
import io

# URLs de l'API
URL_CODES = "https://metro-ci.alwaysdata.net/codes.php"
URL_SUPPRESSION = "https://metro-ci.alwaysdata.net/supprimer_code.php"
URL_IMAGE = "https://preview.redd.it/wvotahcxbkb71.png?width=1920&format=png&auto=webp&s=41abb2eba00fdafb11e788efdf8e31090fcc5a9d"

HEADERS = {'User-Agent': 'Mozilla/5.0'}

def supprimer_code_distant(code):
    try:
        response = requests.post(URL_SUPPRESSION, data={'code': code}, headers=HEADERS, timeout=5)
        result = response.json()
        print(result)
    except Exception as e:
        print(f"Erreur lors de la suppression : {e}")

def verifier_code():
    code_saisi = entry.get().strip()
    code_valide = False

    try:
        response = requests.get(URL_CODES, headers=HEADERS, timeout=5)
        codes = response.json()

        for item in codes:
            code = item['code']
            date_str = item['date']
            try:
                date_gen = datetime.strptime(date_str, "%Y-%m-%d %H:%M:%S")
                if code == code_saisi and datetime.now() - date_gen < timedelta(hours=24):
                    label_resultat.config(text="Accès autorisé", fg="green")
                    code_valide = True
                    supprimer_code_distant(code_saisi)
                    break
            except ValueError:
                continue

        if not code_valide:
            label_resultat.config(text="Code invalide ou expiré", fg="red")

    except Exception as e:
        label_resultat.config(text=f"Erreur : {e}", fg="orange")

def charger_image(url):
    try:
        response = requests.get(url, headers=HEADERS, timeout=5)
        image_data = response.content
        image = Image.open(io.BytesIO(image_data))
        return image
    except Exception as e:
        print(f"Erreur chargement image : {e}")
        return None

def redimensionner_image(event):
    global background_photo
    if background_image:
        img = background_image.resize((event.width, event.height), Image.ANTIALIAS)
        background_photo = ImageTk.PhotoImage(img)
        canvas.create_image(0, 0, image=background_photo, anchor="nw")
    
    # Recentrer tous les éléments
    center_x = event.width // 2
    canvas.coords(label_window, center_x, 60)
    canvas.coords(entry_window, center_x, 110)
    canvas.coords(btn_window, center_x, 160)
    canvas.coords(resultat_window, center_x, 210)

# Interface Tkinter
root = tk.Tk()
root.title("Validation Code Métro")
root.geometry("500x300")

background_image = charger_image(URL_IMAGE)
background_photo = None

canvas = tk.Canvas(root, highlightthickness=0)
canvas.pack(fill="both", expand=True)

if background_image:
    background_photo = ImageTk.PhotoImage(background_image)
    canvas.create_image(0, 0, image=background_photo, anchor="nw")

# Styles
font_title = ("Helvetica", 16, "bold")
font_text = ("Helvetica", 12)

label = tk.Label(root, text="Entrer le code d'accès :", bg="#ffffff", font=font_title)
entry = tk.Entry(root, font=font_text, width=30, justify="center")
btn = tk.Button(root, text="Valider", command=verifier_code, font=font_text, width=20, bg="#4CAF50", fg="white", relief="raised", bd=3)
label_resultat = tk.Label(root, text="", bg="#ffffff", font=font_text)

# Placement avec des références pour pouvoir les repositionner
label_window = canvas.create_window(250, 60, window=label)
entry_window = canvas.create_window(250, 110, window=entry)
btn_window = canvas.create_window(250, 160, window=btn)
resultat_window = canvas.create_window(250, 210, window=label_resultat)

root.bind("<Configure>", redimensionner_image)
root.mainloop()