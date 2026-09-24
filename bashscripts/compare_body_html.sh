#!/bin/bash

# Script per confrontare il contenuto del tag body di due pagine HTML
# Esclude gli script e confronta solo il contenuto del body

# Verifica che siano passati due argomenti
if [ $# -ne 2 ]; then
    echo "Uso: $0 <file1.html> <file2.html>"
    exit 1
fi

FILE1="$1"
FILE2="$2"

# Controlla che i file esistano
if [ ! -f "$FILE1" ]; then
    echo "Errore: il file $FILE1 non esiste"
    exit 1
fi

if [ ! -f "$FILE2" ]; then
    echo "Errore: il file $FILE2 non esiste"
    exit 1
fi

# Estrae il contenuto del body escludendo gli script
# Usa sed per rimuovere i tag script e poi confronta
sed -n '/<body>/,/<\/body>/p' "$FILE1" | sed '/<script>/,/<\/script>/d' > /tmp/body1.html
sed -n '/<body>/,/<\/body>/p' "$FILE2" | sed '/<script>/,/<\/script>/d' > /tmp/body2.html

# Confronta i file
if diff -q /tmp/body1.html /tmp/body2.html > /dev/null; then
    echo "I contenuti del body sono identici (esclusi gli script)"
    exit 0
else
    echo "I contenuti del body sono diversi (esclusi gli script)"
    diff /tmp/body1.html /tmp/body2.html
    exit 1
fi

# Pulizia
rm -f /tmp/body1.html /tmp/body2.html