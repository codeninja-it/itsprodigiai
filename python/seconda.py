import os

def clear():
    if os.name == "nt":
        os.system("cls")
    else:
        os.system("clear")

def somma(a, b):
    c = a + b
    return str(a) + " + " + str(b) + " = " + str(c)

def sottrai(a, b):
    c = a - b
    return str(a) + " - " + str(b) + " = " + str(c)

def moltiplica(a, b):
    c = a * b
    return str(a) + " * " + str(b) + " = " + str(c)

def dividi(a, b):
    c = a / b
    return str(a) + " / " + str(b) + " = " + str(c)
    
continua = True

while continua:
    print("Comando:\t", end="")
    comando = input()
    
    # intercetta operazione
    match comando:
        case "esci":
            print("Arrivederci!")
            operazione = None
            continua = False
        case "moltiplica":
            operazione = moltiplica
        case "dividi":
            operazione = dividi
        case "sottrai":
            operazione = sottrai
        case "somma":
            operazione = somma
        case _:
            print("Non ho capito...")
            operazione = None
        
    # interagisci
    if operazione != None:
        clear()
        print("Base:\t", end="")
        base = int( input() )
        print("Ripetizioni:\t", end="")
        n = int( input() )
        for i in range(1, n + 1):
            print( operazione(base, i) )