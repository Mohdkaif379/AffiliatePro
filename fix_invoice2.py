# Read the file
with open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'r') as f:
    lines = f.readlines()

# Remove duplicate lines
seen = set()
new_lines = []
for line in lines:
    if line.strip() not in seen:
        new_lines.append(line)
        seen.add(line.strip())

# Write back
with open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'w') as f:
    f.writelines(new_lines)

print("Done! Removed duplicates.")

