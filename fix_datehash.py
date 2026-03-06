content = open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'r').read()
content = content.replace("$dateHash = now()->format('Ymd');\n        $dateHash .= $toDate ? Carbon::parse($toDate)->format('Ymd') : '';", "$dateHash = now()->format('Ymd');")
open(r'c:\Users\Admin\AffiliateProgramme\app\Http\Controllers\Accountant\AccountantController.php', 'w').write(content)
print("Done!")
