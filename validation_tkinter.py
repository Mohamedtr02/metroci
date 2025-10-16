import tkinter as tk
from datetime import datetime, timedelta

def verifier_code():
    code_saisi = entry.get().strip()
    lignes = []
    code_valide = False

    try:
        with open("codes.txt", "r") as f:
            lignes = f.readlines()

        with open("codes.txt", "w") as f:
            for ligne in lignes:
                code, date_str = ligne.strip().split(";")
                date_gen = datetime.strptime(date_str, "%Y-%m-%d %H:%M:%S")
                if code == code_saisi and datetime.now() - date_gen < timedelta(hours=24):
                    label_resultat.config(text="Accès autorisé", fg="green")
                    code_valide = True
                else:
                    f.write(ligne)

        if not code_valide:
            label_resultat.config(text="Code invalide ou expiré", fg="red")
    except Exception as e:
        label_resultat.config(text=f"Erreur : {e}", fg="orange")

# Interface Tkinter
root = tk.Tk()
root.title("Validation Code Métro")
root.geometry("400x200")

label = tk.Label(root, text="Entrer le code d'accès :")
label.pack(pady=10)

entry = tk.Entry(root)
entry.pack()

btn = tk.Button(root, text="Valider", command=verifier_code)
btn.pack(pady=10)

label_resultat = tk.Label(root, text="")
label_resultat.pack(pady=10)

root.mainloop()
