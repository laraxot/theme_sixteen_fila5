#!/bin/bash

################################################################################
# HTML Body Comparison Tool - Agnostico
# 
# Confronta il contenuto del tag <body> di due file HTML, escludendo i tag <script>
# Uso: ./compare_body.sh <file1.html> <file2.html> [options]
#
# Options:
#   -v, --verbose    Output dettagliato
#   -s, --stats      Mostra statistiche confronto
#   -h, --help       Mostra questo help
################################################################################

set -e

# Colori per output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Funzione per estrarre body senza script
extract_body_no_scripts() {
    local input_file="$1"
    local output_file="$2"
    
    # Estrae body e rimuove script (multiline sed)
    sed -n '/<body>/,/<\/body>/p' "$input_file" | \
        sed -e '/<script/,/<\/script>/d' \
            -e '/<script>/,/<\/script>/d' \
            -e '/<script [^>]*>/,/<\/script>/d' \
            -e 's/[[:space:]]\+/ /g' \
            -e 's/^[[:space:]]*//' \
            -e 's/[[:space:]]*$//' > "$output_file"
}

# Funzione per calcolare similarità
calculate_similarity() {
    local file1="$1"
    local file2="$2"
    
    if command -v diff &> /dev/null && command -v wc &> /dev/null; then
        local lines1=$(wc -l < "$file1")
        local lines2=$(wc -l < "$file2")
        
        if [ "$lines1" -eq 0 ] || [ "$lines2" -eq 0 ]; then
            echo "0"
            return
        fi
        
        # Calcola similarità basata su linee
        local common=$(diff "$file1" "$file2" 2>/dev/null | grep "^[<>]" | wc -l || echo "0")
        local total=$((lines1 + lines2))
        
        if [ "$total" -gt 0 ]; then
            local similarity=$((200 * (total - common) / total))
            echo "$similarity"
        else
            echo "0"
        fi
    else
        echo "N/A"
    fi
}

# Funzione per mostrare help
show_help() {
    head -20 "$0" | tail -18
    echo ""
    echo "Esempi:"
    echo "  ./compare_body.sh reference.html local.html"
    echo "  ./compare_body.sh reference.html local.html --stats"
    echo "  ./compare_body.sh a.html b.html -v"
    exit 0
}

# Parsing argomenti
VERBOSE=false
STATS=false

while [[ $# -gt 0 ]]; do
    case $1 in
        -v|--verbose)
            VERBOSE=true
            shift
            ;;
        -s|--stats)
            STATS=true
            shift
            ;;
        -h|--help)
            show_help
            ;;
        -*)
            echo "Opzione sconosciuta: $1"
            exit 1
            ;;
        *)
            break
            ;;
    esac
done

# Verifica argomenti base
if [ $# -lt 2 ]; then
    echo -e "${RED}Errore: Servono almeno 2 argomenti${NC}"
    echo "Uso: $0 <file1.html> <file2.html> [options]"
    exit 1
fi

FILE1="$1"
FILE2="$2"

# Controlla esistenza file
for file in "$FILE1" "$FILE2"; do
    if [ ! -f "$file" ]; then
        # Prova come URL
        if [[ "$file" =~ ^https?:// ]]; then
            echo -e "${YELLOW}Nota: $file sembra un URL, scaricamento non supportato automaticamente${NC}"
        else
            echo -e "${RED}Errore: il file $file non esiste${NC}"
            exit 1
        fi
    fi
done

# File temporanei
TEMP_DIR=$(mktemp -d)
trap "rm -rf $TEMP_DIR" EXIT

BODY1="$TEMP_DIR/body1.html"
BODY2="$TEMP_DIR/body2.html"

# Estrai body senza script
echo -e "${BLUE}Estrazione body (senza script) da: $FILE1${NC}"
extract_body_no_scripts "$FILE1" "$BODY1"

echo -e "${BLUE}Estrazione body (senza script) da: $FILE2${NC}"
extract_body_no_scripts "$FILE2" "$BODY2"

# Statistiche
if [ "$STATS" = true ]; then
    echo ""
    echo -e "${YELLOW}=== STATISTICHE ===${NC}"
    echo "File 1: $(wc -l < "$BODY1") righe, $(wc -c < "$BODY1") bytes"
    echo "File 2: $(wc -l < "$BODY2") righe, $(wc -c < "$BODY2") bytes"
    echo "Similarità: $(calculate_similarity "$BODY1" "$BODY2")%"
fi

# Confronto
echo ""
echo -e "${YELLOW}=== CONFRONTO BODY HTML (script esclusi) ===${NC}"

if diff -q "$BODY1" "$BODY2" > /dev/null 2>&1; then
    echo -e "${GREEN}✓ I contenuti del body sono IDENTICI${NC}"
    exit 0
else
    echo -e "${RED}✗ I contenuti del body sono DIVERSI${NC}"
    
    if [ "$VERBOSE" = true ]; then
        echo ""
        echo -e "${YELLOW}=== DIFFERENZE ===${NC}"
        diff -u "$BODY1" "$BODY2" | head -100
    else
        echo ""
        echo "Usa --verbose per vedere le differenze dettagliate"
        echo "Usa --stats per statistiche confronto"
        
        # Riga di riepilogo rapido
        diff_count=$(diff "$BODY1" "$BODY2" 2>/dev/null | grep "^[<>]" | wc -l || echo "0")
        echo "Differenze rilevate: $diff_count linee"
    fi
    
    exit 1
fi