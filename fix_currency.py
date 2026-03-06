# Fix the currency symbol encoding issue
content = open(r'c:\Users\Admin\AffiliateProgramme\resources\views\accountant\invoice_pdf.blade.php', 'r').read()

# Replace the garbled currency symbol with INR
content = content.replace('â‚¹', 'INR')

# Also replace the rupee symbol variants
content = content.replace('₹', 'INR')

open(r'c:\Users\Admin\AffiliateProgramme\resources\views\accountant\invoice_pdf.blade.php', 'w').write(content)
print("Currency fixed!")
