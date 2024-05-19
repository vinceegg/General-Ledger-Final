import os

# List of filenames
filenames = [
'RetirementandLifeInsurancePremiumsImport.php',
'PagibigContributionsImport.php',
'PhilHealthContributionsImport.php',
'EmployeesCompensationInsurancePremiumsImport.php',
'TerminalLeaveBenefitsImport.php',
'OtherPersonnelBenefitsImport.php',
'TravelingExpensesLocalImport.php',
'TrainingExpensesImport.php',
'OfficeSuppliesExpensesImport.php',
'AccountableFormsExpensesImport.php',
'DrugsandMedicinesExpensesImport.php',
'MedicalDentalandLaboratorySuppliesExpensesImport.php',
'FuelOilandLubricantsExpensesImport.php',
'OtherSuppliesandMaterialsExpensesImport.php',
'WaterExpensesImport.php',
'ElectricityExpensesImport.php',
'PostageandCourierServicesImport.php',
'TelephoneExpensesImport.php',
'InternetSubscriptionExpensesImport.php',
'ExtraordinaryandMiscellaneousExpensesImport.php',
'MotorVehiclesImport.php',
'AccumulatedDepreciationMotorVehiclesImport.php',
'FurnitureandFixturesImport.php',
'AccumulatedDepreciationFurnitureandFixturesImport.php',
'BuildingsandOtherStructuresImport.php',
'AccountsPayableImport.php',
'DuetoOfficersandEmployeesImport.php',
'DuetoBIRImport.php',
'DuetoGSISImport.php',
'DuetoPAGIBIGImport.php',
'DuetoPHILHEALTHExport.php'
]

# Specify the directory
directory = 'app/Imports'  # Change this to your desired directory

# Ensure the directory exists
os.makedirs(directory, exist_ok=True)

# Content to write to each file
file_content = '''<?php

namespace App\Imports;

use App\Models\AccountsReceivableModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountsReceivableImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new AccountsReceivableModel([
            'gl_date'               => $row['date'],
            'gl_vouchernum'         => $row['voucher_no'],
            'gl_particulars'        => $row['particulars'],
            'gl_balance_debit'      => $row['balance_debit'],
            'gl_debit'              => $row['debits'],
            'gl_credit'             => $row['credits'],
            'gl_credit_balance'     => $row['credits_balance']
        ]);

    }

    public function prepareForValidation($data, $index)
    {
        $keys = array_keys($data);
        $values = array_values($data);

        $keys = array_map(function ($key) {
            $key = str_replace(' ', '_', $key); // Replace spaces with underscores
            $key = str_replace('&', '_', $key); // Replace ampersand with underscore
            return strtolower($key);           // Convert to lowercase
        }, $keys);

        return array_combine($keys, $values);
    }

    public function headingRow(): int
    {
        return 1; // Assuming the first row contains the headers
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
