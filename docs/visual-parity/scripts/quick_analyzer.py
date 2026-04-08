#!/usr/bin/env python3
"""Quick HTML structure analyzer for visual parity."""

import sys
from html.parser import HTMLParser
from pathlib import Path

def analyze_structure(filepath):
    """Analyze HTML structure and return key metrics."""
    content = Path(filepath).read_text(encoding='utf-8')
    
    class StructParser(HTMLParser):
        def __init__(self):
            super().__init__()
            self.divs = 0
            self.as_ = 0
            self.sections = 0
            self.h1 = 0
            self.h2 = 0
            self.cards = 0
            self.headings = []
            
        def handle_starttag(self, tag, attrs):
            if tag == 'div':
                self.divs += 1
            elif tag == 'a':
                self.as_ += 1
            elif tag == 'section':
                self.sections += 1
            elif tag == 'h1':
                self.h1 += 1
            elif tag == 'h2':
                self.h2 += 1
                self.headings.append('h2')
            elif tag in ['h3', 'h4', 'h5', 'h6']:
                self.headings.append(tag)
            elif tag == 'article':
                self.cards += 1
    
    parser = StructParser()
    parser.feed(content)
    
    # Get body content length
    body_start = content.find('<body')
    body_end = content.find('</body>')
    body_content = content[body_start:body_end] if body_start != -1 and body_end != -1 else ''
    
    print(f"\n=== {Path(filepath).name} ===")
    print(f"Divs: {parser.divs}")
    print(f"Links <a>: {parser.as_}")
    print(f"Sections: {parser.sections}")
    print(f"H1: {parser.h1}, H2: {parser.h2}")
    print(f"Cards <article>: {parser.cards}")
    print(f"Body chars: {len(body_content)}")
    print(f"Headings found: {parser.headings[:10]}")

if __name__ == '__main__':
    for f in sys.argv[1:]:
        analyze_structure(f)
