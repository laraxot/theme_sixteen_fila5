#!/usr/bin/env python3
"""
HTML Structure Parity Checker - Design Comuni Italia
Compares HTML STRUCTURE (tags, classes, attributes) between AGID original and FixCity
Ignores: whitespace, text content, formatting
Focus: Structural parity only
"""

import re
import sys
from pathlib import Path
from urllib.parse import urlparse

def download_html(url, output_file):
    """Download HTML from URL"""
    import subprocess
    result = subprocess.run(['curl', '-s', url, '-o', output_file], capture_output=True, text=True)
    return result.returncode == 0

def extract_body(html):
    """Extract body content excluding scripts"""
    body_match = re.search(r'<body[^>]*>(.*?)</body>', html, re.DOTALL | re.IGNORECASE)
    if not body_match:
        return ""
    
    body = body_match.group(1)
    # Remove scripts
    body = re.sub(r'<script[^>]*>.*?</script>', '', body, flags=re.DOTALL | re.IGNORECASE)
    # Remove comments
    body = re.sub(r'<!--.*?-->', '', body, flags=re.DOTALL)
    return body

def normalize_html(body):
    """Normalize HTML for structural comparison"""
    # Normalize whitespace
    body = re.sub(r'\s+', ' ', body)
    # Normalize attribute order (sort attributes alphabetically)
    def sort_attrs(match):
        tag = match.group(1)
        attrs = match.group(2) or ""
        # Sort attributes
        attr_list = re.findall(r'(\S+?="[^"]*"|\S+)', attrs)
        attr_list.sort()
        if attr_list:
            return f'<{tag} {" ".join(attr_list)}>'
        return f'<{tag}>'
    
    body = re.sub(r'<([a-zA-Z][a-zA-Z0-9]*)([^>]*)>', sort_attrs, body)
    # Normalize self-closing tags
    body = re.sub(r'\s*/>', '/>', body)
    return body.strip()

def extract_structure(html):
    """Extract structural signature: tag@class#id[attr]"""
    structure = []
    # Match opening tags with their attributes
    pattern = r'<([a-zA-Z][a-zA-Z0-9]*)([^>]*)>'
    for match in re.finditer(pattern, html):
        tag = match.group(1)
        attrs = match.group(2)
        
        # Extract class, id, and other attributes
        class_match = re.search(r'class="([^"]*)"', attrs)
        id_match = re.search(r'id="([^"]*)"', attrs)
        other_attrs = re.findall(r'(?!class=|id=)(\S+?)="[^"]*"', attrs)
        
        signature = f"{tag}"
        if class_match:
            signature += f".{class_match.group(1).replace(' ', '.')}"
        if id_match:
            signature += f"#{id_match.group(1)}"
        for attr in sorted(other_attrs):
            attr_name = attr.split('=')[0]
            signature += f"[{attr_name}]"
        
        structure.append(signature)
    
    return structure

def compare_structure(agid_struct, fixcity_struct):
    """Compare two structure lists"""
    import difflib
    
    agid_lines = agid_struct
    fixcity_lines = fixcity_struct
    
    # Calculate similarity
    matcher = difflib.SequenceMatcher(None, agid_lines, fixcity_lines)
    similarity = matcher.ratio() * 100
    
    # Find differences
    diff = list(difflib.unified_diff(agid_lines, fixcity_lines, lineterm='', n=0))
    
    return similarity, diff

def generate_report(agid_file, fixcity_file, output_file):
    """Generate parity report"""
    # Read files
    with open(agid_file, 'r', encoding='utf-8') as f:
        agid_html = f.read()
    
    with open(fixcity_file, 'r', encoding='utf-8') as f:
        fixcity_html = f.read()
    
    # Extract and normalize
    agid_body = extract_body(agid_html)
    fixcity_body = extract_body(fixcity_html)
    
    agid_norm = normalize_html(agid_body)
    fixcity_norm = normalize_html(fixcity_body)
    
    # Extract structure
    agid_struct = extract_structure(agid_norm)
    fixcity_struct = extract_structure(fixcity_norm)
    
    # Compare
    similarity, diff = compare_structure(agid_struct, fixcity_struct)
    
    # Generate report
    report = []
    report.append("# HTML Structure Parity Report")
    report.append(f"**Date**: {Path(__file__).stat().st_mtime}")
    report.append(f"**Status**: {'✅ PASS' if similarity >= 95 else '❌ FAIL'}")
    report.append("")
    report.append("## 📊 Metrics")
    report.append(f"- **AGID Original**: {len(agid_struct)} elements")
    report.append(f"- **FixCity**: {len(fixcity_struct)} elements")
    report.append(f"- **Structural Match**: {similarity:.2f}%")
    report.append(f"- **Target**: 95%+")
    report.append("")
    
    if similarity < 95:
        report.append("## ❌ Structural Differences")
        report.append("")
        report.append("### Missing in FixCity:")
        missing = [line for line in diff if line.startswith('-')]
        for item in missing[:20]:  # Show first 20
            report.append(f"- `{item[1:]}`")
        if len(missing) > 20:
            report.append(f"- ... and {len(missing) - 20} more")
        
        report.append("")
        report.append("### Extra in FixCity:")
        extra = [line for line in diff if line.startswith('+')]
        for item in extra[:20]:  # Show first 20
            report.append(f"- `{item[1:]}`")
        if len(extra) > 20:
            report.append(f"- ... and {len(extra) - 20} more")
    
    report.append("")
    report.append("## 🎯 Priority Fixes")
    if similarity < 95:
        report.append("1. Fix missing structural elements")
        report.append("2. Remove extra elements")
        report.append("3. Verify class names match")
        report.append("4. Verify attribute names match")
    else:
        report.append("✅ Structure is compliant!")
    
    # Write report
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write('\n'.join(report))
    
    print(f"Report saved to: {output_file}")
    print(f"Structural Match: {similarity:.2f}%")
    return similarity >= 95

if __name__ == '__main__':
    import sys
    
    if len(sys.argv) < 3:
        print("Usage: html_parity_check.py <agid_html> <fixcity_html> [output_report]")
        sys.exit(1)
    
    agid_file = sys.argv[1]
    fixcity_file = sys.argv[2]
    output_file = sys.argv[3] if len(sys.argv) > 3 else 'html_parity_report.md'
    
    success = generate_report(agid_file, fixcity_file, output_file)
    sys.exit(0 if success else 1)
