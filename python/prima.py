# creare un sistema che permetta ai nostri utenti di
# scegliere un comando tra moltiplica, dividi, somma, sottrai ed
# esci ed esegua la relativa tabellina, se utente dice esci il
# ciclo si interrompe

# primo programma
print("Ciao!\nCome ti chiami?")
# recupero il nome
nome = input()
print("Ok " + nome + " che tabellina vuoi?")
base = int( input() )
print("fino a quanto?")
n = input()
print("Eccotela!")
print("-" * 10)
for i in range(0, int(n), 1):
    print(base * i)
    
