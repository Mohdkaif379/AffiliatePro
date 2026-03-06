import re

# Read the file
with open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'r') as f:
    content = f.read()

# Replace the dateHash lines
old_pattern = "$dateHash = $fromDate ? XXX($fromDate)->format('Ymd') : '';"
new_pattern = "$dateHash = now()->format('Ymd');"

content = content.replace(old_pattern, new_pattern)

# Write back
with open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'w') as f:
    f.write(content)

print("Done!")

