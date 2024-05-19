import os

# List of filenames
filenames = [
'cash-local-treasury-modal.blade.php',
'petty-cash-modal.blade.php',
'cash-in-bank-local-currency-current-account-modal.blade.php',
'cash-in-bank-local-currency-time-deposits-modal.blade.php',
'accounts-receivable-modal.blade.php',
'acc-depreciation-disaster-response-and-rescue-equipment-modal.blade.php',
'acc-depreciation-military-police-security-eqpmnt-modal.blade.php',
'acc-depreciation-other-machinery-equipment-modal.blade.php',
'acc-depreciation-technical-scientific-equipment-modal.blade.php',
'accumulated-depreciation-ict-equipment-modal.blade.php',
'accumulated-depreciation-medical-equipment-modal.blade.php',
'accumulated-depreciation-office-equipment-modal.blade.php',
'accumulated-depreciation-sports-equipment-modal.blade.php',
'cash-gift-modal.blade.php',
'clothing-uniform-allowance-modal.blade.php',
'disaster-response-and-rescue-equipment-modal.blade.php',
'grants-donations-in-kind-modal.blade.php',
'hazard-pay-modal.blade.php',
'honoraria-modal.blade.php',
'info-and-communication-technology-equipment-modal.blade.php',
'interests-receivable-modal.blade.php',
'longetivity-pay-modal.blade.php',
'medical-equipment-modal.blade.php',
'military-police-security-equipment-modal.blade.php',
'miscellaneous-income-modal.blade.php',
'office-equipment-modal.blade.php',
'other-machinery-equipment-modal.blade.php',
'overtime-and-night-pay-modal.blade.php',
'personnel-economic-relief-allowance-modal.blade.php',
'representation-allowance-modal.blade.php',
'salaries-and-wages-casual-contractual-modal.blade.php',
'salaries-and-wages-regular-modal.blade.php',
'sports-equipment-modal.blade.php',
'technical-and-scientific-equipment-modal.blade.php',
'transportation-allowance-modal.blade.php',
'year-end-bonus-modal.blade.php',
'accountable-forms-expenses-modal.blade.php',
'accounts-payable-modal.blade.php',
'accumulated-depreciation-furniture-and-fixtures-modal.blade.php',
'accumulated-depreciation-motor-vehicles-modal.blade.php',
'buildings-and-other-structures-modal.blade.php',
'drugs-and-medicines-expenses-modal.blade.php',
'due-to-bir-modal.blade.php',
'due-to-gsis-modal.blade.php',
'due-to-officers-and-employees-modal.blade.php',
'due-to-pag-ibig-modal.blade.php',
'due-to-philhealth-modal.blade.php',
'electricity-expenses-modal.blade.php',
'employees-compensation-insurance-premiums-modal.blade.php',
'extraordinary-and-miscellaneous-expenses-modal.blade.php',
'fuel-oil-and-lubricants-expenses-modal.blade.php',
'furniture-and-fixtures-modal.blade.php',
'internet-subscription-expenses-modal.blade.php',
'medical-dental-and-laboratory-supplies-expenses-modal.blade.php',
'motor-vehicles-modal.blade.php',
'office-supplies-expenses-modal.blade.php',
'other-personnel-benefits-modal.blade.php',
'other-supplies-and-materials-expenses-modal.blade.php',
'pag-ibig-contributions-modal.blade.php',
'philhealth-contributions-modal.blade.php',
'postage-and-courier-services-modal.blade.php',
'retirement-and-life-insurance-premiums-modal.blade.php',
'telephone-expenses-modal.blade.php',
'terminal-leave-benefits-modal.blade.php',
'training-expenses-modal.blade.php',
'traveling-expenses-local-modal.blade.php',
'water-expenses-modal.blade.php',
'affiliation-fees-modal.blade.php',
'bank-charges-modal.blade.php',
'customers-deposit-modal.blade.php',
'depreciation-building-and-structures-modal.blade.php',
'depreciation-furnitures-and-books-modal.blade.php',
'depreciation-machinery-and-equipment-modal.blade.php',
'depreciation-transportation-equipment-modal.blade.php',
'fidelity-bond-premiums-modal.blade.php',
'fines-and-penalties-service-income-modal.blade.php',
'government-equity-modal.blade.php',
'guaranty-security-deposits-payable-modal.blade.php',
'insurance-expenses-modal.blade.php',
'interest-income-modal.blade.php',
'membership-dues-and-contribution-to-org-modal.blade.php',
'other-business-income-modal.blade.php',
'other-deferred-credits-modal.blade.php',
'other-maintenance-and-operating-expenses-modal.blade.php',
'other-payables-modal.blade.php',
'other-professional-services-modal.blade.php',
'printing-and-publication-expenses-modal.blade.php',
'prior-period-adjustment-modal.blade.php',
'rent-expenses-modal.blade.php',
'rent-income-modal.blade.php',
'repairs-and-maint-building-other-structures-modal.blade.php',
'repairs-and-maint-machinery-and-equipment-modal.blade.php',
'repairs-and-maint-transportation-equipment-modal.blade.php',
'representation-expenses-modal.blade.php',
'school-fees-modal.blade.php',
'subscription-expenses-modal.blade.php',
'subsidy-from-lgus-modal.blade.php',
'trust-liabilities-modal.blade.php'
]

# Specify the directory
directory = 'resources/views/livewire'  # Change this to your desired directory

# Ensure the directory exists
os.makedirs(directory, exist_ok=True)

# Content to write to each file
file_content = '''

'''

# Iterate over the list of filenames and create each file with the specified content
for filename in filenames:
    # Create the full path to the file
    file_path = os.path.join(directory, filename)
    # Create the file and write the content
    with open(file_path, 'w') as file:
        file.write(file_content)

print("Files created successfully with the specified content.")
