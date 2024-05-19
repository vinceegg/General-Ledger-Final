import os

# List of filenames
filenames = [
'TrustLiabilitiesExport.php',
'GuarantySecurityDepositsPayableExport.php',
'CustomersDepositExport.php',
'OtherDeferredCreditsExport.php',
'OtherPayablesExport.php',
'GovernmentEquityExport.php',
'PriorPeriodAdjustmentExport.php',
'FinesandPenaltiesServiceIncomeExport.php',
'SchoolFeesExport.php',
'AffiliationFeesExport.php',
'RentIncomeExport.php',
'InterestIncomeExport.php',
'OtherBusinessIncomeExport.php',
'SubsidyfromLGUsExport.php',
'OtherProfessionalServicesExport.php',
'RepairsandMaintBuildingOtherStructuresExport.php',
'RepairsandMaintMachineryandEquipmentExport.php',
'RepairsandMaintTransportationEquipmentExport.php',
'FidelityBondPremiumsExport.php',
'InsuranceExpensesExport.php',
'PrintingandPublicationExpensesExport.php',
'RepresentationExpensesExport.php',
'RentExpensesExport.php',
'MembershipDuesandContributiontoOrgExport.php',
'SubscriptionExpensesExport.php',
'OtherMaintenanceandOperatingExpensesExport.php',
'BankChargesExport.php',
'DepreciationBuildingandStructuresExport.php',
'DepreciationMachineryandEquipmentExport.php',
'DepreciationTransportationEquipmentExport.php',
'DepreciationFurnituresandBooksExport.php'

]

# Specify the directory
directory = 'app/Exports'  # Change this to your desired directory

# Ensure the directory exists
os.makedirs(directory, exist_ok=True)

# Content to write to each file
file_content = '''<?php

namespace App\Exports;

use App\Models\AccountsReceivableModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccountsReceivableExport implements  FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AccountsReceivableModel::select(
        "gl_date",
        "gl_vouchernum",
        "gl_particulars",
        "gl_balance_debit",
        "gl_debit",
        'gl_credit',
        "gl_credit_balance", )->get();
    }

    public function headings(): array
    {
        return [
            "Date",
            "Voucher No.",
            "Particulars",
            "Balance Debit",
            "Debits",
            "Credits",
            "Credits Balance"];
    }
}

'''

# Iterate over the list of filenames and create each file with the specified content
for filename in filenames:
    # Create the full path to the file
    file_path = os.path.join(directory, filename)
    # Create the file and write the content
    with open(file_path, 'w') as file:
        file.write(file_content)

print("Files created successfully with the specified content.")
