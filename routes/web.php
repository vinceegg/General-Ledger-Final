<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;


Route::get('/', function () {
    return view('auth.register');
});

Route::resource('verify', TwoFactorController::class);

Route::get('/dashboard',  function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'two_factor'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
require __DIR__.'/auth.php';

//Routes for each table of journals
Route::get('/CRJ', [App\Http\Controllers\CashReceiptJournalController::class, 'index'])->name('CRJ');
Route::get('/CKDJ', [App\Http\Controllers\CheckDisbursementJournalController::class, 'index'])->name('CKDJ');
Route::get('/CDJ', [App\Http\Controllers\CashDisbursementJournalController::class, 'index'])->name('CDJ');
Route::get('/GJ', [App\Http\Controllers\GeneralJournalController::class, 'index'])->name('GJ');
Route::get('/LS', [App\Http\Controllers\GeneralLedgerController::class, 'index'])->name('LS');

Route::get('/AC', function () {
    return view('accounthomepage');
});

//Routes for Account Codes
// FORMAT: Route::get('/CashLocalTreasury', [App\Http\Controllers\CashLocalTreasury::class, 'index'])->name('CashLocalTreasury');
Route::get('/CashLocalTreasury', [App\Http\Controllers\CashLocalTreasury::class, 'index'])->name('CashLocalTreasury');
Route::get('/PettyCash', [App\Http\Controllers\PettyCash::class, 'index'])->name('PettyCash');
Route::get('/CashinBankLocalCurrencyCurrentAccount', [App\Http\Controllers\CashinBankLocalCurrencyCurrentAccount::class, 'index'])->name('CashinBankLocalCurrencyCurrentAccount');
Route::get('/CashinBankLocalCurrencyTimeDeposits', [App\Http\Controllers\CashinBankLocalCurrencyTimeDeposits::class, 'index'])->name('CashinBankLocalCurrencyTimeDeposits');
Route::get('/AccountsReceivable', [App\Http\Controllers\AccountsReceivable::class, 'index'])->name('AccountsReceivable');
Route::get('/InterestsReceivable', [App\Http\Controllers\InterestsReceivable::class, 'index'])->name('InterestsReceivable');
Route::get('/OfficeEquipment', [App\Http\Controllers\OfficeEquipment::class, 'index'])->name('OfficeEquipment');
Route::get('/AccumulatedDepreciationOfficeEquipment', [App\Http\Controllers\AccumulatedDepreciationOfficeEquipment::class, 'index'])->name('AccumulatedDepreciationOfficeEquipment');
Route::get('/InfoandCommunicationTechnologyEquipment', [App\Http\Controllers\InfoandCommunicationTechnologyEquipment::class, 'index'])->name('InfoandCommunicationTechnologyEquipment');
Route::get('/AccumulatedDepreciationICTEquipment', [App\Http\Controllers\AccumulatedDepreciationICTEquipment::class, 'index'])->name('AccumulatedDepreciationICTEquipment');
Route::get('/DisasterResponseandRescueEquipment', [App\Http\Controllers\DisasterResponseandRescueEquipment::class, 'index'])->name('DisasterResponseandRescueEquipment');
Route::get('/AccDepreciationDisasterResponseandRescueEquipment', [App\Http\Controllers\AccDepreciationDisasterResponseandRescueEquipment::class, 'index'])->name('AccDepreciationDisasterResponseandRescueEquipment');
Route::get('/MilitaryPoliceSecurityEquipment', [App\Http\Controllers\MilitaryPoliceSecurityEquipment::class, 'index'])->name('MilitaryPoliceSecurityEquipment');
Route::get('/AccDepreciationMilitaryPoliceSecurityEqpmnt', [App\Http\Controllers\AccDepreciationMilitaryPoliceSecurityEqpmnt::class, 'index'])->name('AccDepreciationMilitaryPoliceSecurityEqpmnt');
Route::get('/MedicalEquipment', [App\Http\Controllers\MedicalEquipment::class, 'index'])->name('MedicalEquipment');
Route::get('/AccumulatedDepreciationMedicalEquipment', [App\Http\Controllers\AccumulatedDepreciationMedicalEquipment::class, 'index'])->name('AccumulatedDepreciationMedicalEquipment');
Route::get('/SportsEquipment', [App\Http\Controllers\SportsEquipment::class, 'index'])->name('SportsEquipment');
Route::get('/AccumulatedDepreciationSportsEquipment', [App\Http\Controllers\AccumulatedDepreciationSportsEquipment::class, 'index'])->name('AccumulatedDepreciationSportsEquipment');
Route::get('/TechnicalandScientificEquipment', [App\Http\Controllers\TechnicalandScientificEquipment::class, 'index'])->name('TechnicalandScientificEquipment');
Route::get('/AccDepreciationTechnicalScientificEquipment', [App\Http\Controllers\AccDepreciationTechnicalScientificEquipment::class, 'index'])->name('AccDepreciationTechnicalScientificEquipment');
Route::get('/OtherMachineryEquipment', [App\Http\Controllers\OtherMachineryEquipment::class, 'index'])->name('OtherMachineryEquipment');
Route::get('/AccDepreciationOtherMachineryEquipment', [App\Http\Controllers\AccDepreciationOtherMachineryEquipment::class, 'index'])->name('AccDepreciationOtherMachineryEquipment');
Route::get('/GrantsDonationsinKind', [App\Http\Controllers\GrantsDonationsinKind::class, 'index'])->name('GrantsDonationsinKind');
Route::get('/MiscellaneousIncome', [App\Http\Controllers\MiscellaneousIncome::class, 'index'])->name('MiscellaneousIncome');
Route::get('/SalariesandWagesRegular', [App\Http\Controllers\SalariesandWagesRegular::class, 'index'])->name('SalariesandWagesRegular');
Route::get('/SalariesandWagesCasualContractual', [App\Http\Controllers\SalariesandWagesCasualContractual::class, 'index'])->name('SalariesandWagesCasualContractual');
Route::get('/PersonnelEconomicReliefAllowance', [App\Http\Controllers\PersonnelEconomicReliefAllowance::class, 'index'])->name('PersonnelEconomicReliefAllowance');
Route::get('/RepresentationAllowance', [App\Http\Controllers\RepresentationAllowance::class, 'index'])->name('RepresentationAllowance');
Route::get('/TransportationAllowance', [App\Http\Controllers\TransportationAllowance::class, 'index'])->name('TransportationAllowance');
Route::get('/ClothingUniformAllowance', [App\Http\Controllers\ClothingUniformAllowance::class, 'index'])->name('ClothingUniformAllowance');
Route::get('/Honoraria', [App\Http\Controllers\Honoraria::class, 'index'])->name('Honoraria');
Route::get('/HazardPay', [App\Http\Controllers\HazardPay::class, 'index'])->name('HazardPay');
Route::get('/LongetivityPay', [App\Http\Controllers\LongetivityPay::class, 'index'])->name('LongetivityPay');
Route::get('/OvertimeandNightPay', [App\Http\Controllers\OvertimeandNightPay::class, 'index'])->name('OvertimeandNightPay');
Route::get('/YearEndBonus', [App\Http\Controllers\YearEndBonus::class, 'index'])->name('YearEndBonus');
Route::get('/CashGift', [App\Http\Controllers\CashGift::class, 'index'])->name('CashGift');
Route::get('/RetirementandLifeInsurancePremiums', [App\Http\Controllers\RetirementandLifeInsurancePremiums::class, 'index'])->name('RetirementandLifeInsurancePremiums');
Route::get('/PagibigContributions', [App\Http\Controllers\PagibigContributions::class, 'index'])->name('PagibigContributions');
Route::get('/PhilHealthContributions', [App\Http\Controllers\PhilHealthContributions::class, 'index'])->name('PhilHealthContributions');
Route::get('/EmployeesCompensationInsurancePremiums', [App\Http\Controllers\EmployeesCompensationInsurancePremiums::class, 'index'])->name('EmployeesCompensationInsurancePremiums');
Route::get('/TerminalLeaveBenefits', [App\Http\Controllers\TerminalLeaveBenefits::class, 'index'])->name('TerminalLeaveBenefits');
Route::get('/OtherPersonnelBenefits', [App\Http\Controllers\OtherPersonnelBenefits::class, 'index'])->name('OtherPersonnelBenefits');
Route::get('/TravelingExpensesLocal', [App\Http\Controllers\TravelingExpensesLocal::class, 'index'])->name('TravelingExpensesLocal');
Route::get('/TrainingExpenses', [App\Http\Controllers\TrainingExpenses::class, 'index'])->name('TrainingExpenses');
Route::get('/OfficeSuppliesExpenses', [App\Http\Controllers\OfficeSuppliesExpenses::class, 'index'])->name('OfficeSuppliesExpenses');
Route::get('/AccountableFormsExpenses', [App\Http\Controllers\AccountableFormsExpenses::class, 'index'])->name('AccountableFormsExpenses');
Route::get('/DrugsandMedicinesExpenses', [App\Http\Controllers\DrugsandMedicinesExpenses::class, 'index'])->name('DrugsandMedicinesExpenses');
Route::get('/MedicalDentalandLaboratorySuppliesExpenses', [App\Http\Controllers\MedicalDentalandLaboratorySuppliesExpenses::class, 'index'])->name('MedicalDentalandLaboratorySuppliesExpenses');
Route::get('/FuelOilandLubricantsExpenses', [App\Http\Controllers\FuelOilandLubricantsExpenses::class, 'index'])->name('FuelOilandLubricantsExpenses');
Route::get('/OtherSuppliesandMaterialsExpenses', [App\Http\Controllers\OtherSuppliesandMaterialsExpenses::class, 'index'])->name('OtherSuppliesandMaterialsExpenses');
Route::get('/WaterExpenses', [App\Http\Controllers\WaterExpenses::class, 'index'])->name('WaterExpenses');
Route::get('/ElectricityExpenses', [App\Http\Controllers\ElectricityExpenses::class, 'index'])->name('ElectricityExpenses');
Route::get('/PostageandCourierServices', [App\Http\Controllers\PostageandCourierServices::class, 'index'])->name('PostageandCourierServices');
Route::get('/TelephoneExpenses', [App\Http\Controllers\TelephoneExpenses::class, 'index'])->name('TelephoneExpenses');
Route::get('/InternetSubscriptionExpenses', [App\Http\Controllers\InternetSubscriptionExpenses::class, 'index'])->name('InternetSubscriptionExpenses');
Route::get('/ExtraordinaryandMiscellaneousExpenses', [App\Http\Controllers\ExtraordinaryandMiscellaneousExpenses::class, 'index'])->name('ExtraordinaryandMiscellaneousExpenses');
Route::get('/MotorVehicles', [App\Http\Controllers\MotorVehicles::class, 'index'])->name('MotorVehicles');
Route::get('/AccumulatedDepreciationMotorVehicles', [App\Http\Controllers\AccumulatedDepreciationMotorVehicles::class, 'index'])->name('AccumulatedDepreciationMotorVehicles');
Route::get('/FurnitureandFixtures', [App\Http\Controllers\FurnitureandFixtures::class, 'index'])->name('FurnitureandFixtures');
Route::get('/AccumulatedDepreciationFurnitureandFixtures', [App\Http\Controllers\AccumulatedDepreciationFurnitureandFixtures::class, 'index'])->name('AccumulatedDepreciationFurnitureandFixtures');
Route::get('/BuildingsandOtherStructures', [App\Http\Controllers\BuildingsandOtherStructures::class, 'index'])->name('BuildingsandOtherStructures');
Route::get('/AccountsPayable', [App\Http\Controllers\AccountsPayable::class, 'index'])->name('AccountsPayable');
Route::get('/DuetoOfficersandEmployees', [App\Http\Controllers\DuetoOfficersandEmployees::class, 'index'])->name('DuetoOfficersandEmployees');
Route::get('/DuetoBIR', [App\Http\Controllers\DuetoBIR::class, 'index'])->name('DuetoBIR');
Route::get('/DuetoGSIS', [App\Http\Controllers\DuetoGSIS::class, 'index'])->name('DuetoGSIS');
Route::get('/DuetoPAGIBIG', [App\Http\Controllers\DuetoPAGIBIG::class, 'index'])->name('DuetoPAGIBIG');
Route::get('/DuetoPHILHEALTH', [App\Http\Controllers\DuetoPHILHEALTH::class, 'index'])->name('DuetoPHILHEALTH');
Route::get('/TrustLiabilities', [App\Http\Controllers\TrustLiabilities::class, 'index'])->name('TrustLiabilities');
Route::get('/GuarantySecurityDepositsPayable', [App\Http\Controllers\GuarantySecurityDepositsPayable::class, 'index'])->name('GuarantySecurityDepositsPayable');
Route::get('/CustomersDeposit', [App\Http\Controllers\CustomersDeposit::class, 'index'])->name('CustomersDeposit');
Route::get('/OtherDeferredCredits', [App\Http\Controllers\OtherDeferredCredits::class, 'index'])->name('OtherDeferredCredits');
Route::get('/OtherPayables', [App\Http\Controllers\OtherPayables::class, 'index'])->name('OtherPayables');
Route::get('/GovernmentEquity', [App\Http\Controllers\GovernmentEquity::class, 'index'])->name('GovernmentEquity');
Route::get('/PriorPeriodAdjustment', [App\Http\Controllers\PriorPeriodAdjustment::class, 'index'])->name('PriorPeriodAdjustment');
Route::get('/FinesandPenaltiesServiceIncome', [App\Http\Controllers\FinesandPenaltiesServiceIncome::class, 'index'])->name('FinesandPenaltiesServiceIncome');
Route::get('/SchoolFees', [App\Http\Controllers\SchoolFees::class, 'index'])->name('SchoolFees');
Route::get('/AffiliationFees', [App\Http\Controllers\AffiliationFees::class, 'index'])->name('AffiliationFees');
Route::get('/RentIncome', [App\Http\Controllers\RentIncome::class, 'index'])->name('RentIncome');
Route::get('/InterestIncome', [App\Http\Controllers\InterestIncome::class, 'index'])->name('InterestIncome');
Route::get('/OtherBusinessIncome', [App\Http\Controllers\OtherBusinessIncome::class, 'index'])->name('OtherBusinessIncome');
Route::get('/SubsidyfromLGUs', [App\Http\Controllers\SubsidyfromLGUs::class, 'index'])->name('SubsidyfromLGUs');
Route::get('/OtherProfessionalServices', [App\Http\Controllers\OtherProfessionalServices::class, 'index'])->name('OtherProfessionalServices');
Route::get('/RepairsandMaintBuildingOtherStructures', [App\Http\Controllers\RepairsandMaintBuildingOtherStructures::class, 'index'])->name('RepairsandMaintBuildingOtherStructures');
Route::get('/RepairsandMaintMachineryandEquipment', [App\Http\Controllers\RepairsandMaintMachineryandEquipment::class, 'index'])->name('RepairsandMaintMachineryandEquipment');
Route::get('/RepairsandMaintTransportationEquipment', [App\Http\Controllers\RepairsandMaintTransportationEquipment::class, 'index'])->name('RepairsandMaintTransportationEquipment');
Route::get('/FidelityBondPremiums', [App\Http\Controllers\FidelityBondPremiums::class, 'index'])->name('FidelityBondPremiums');
Route::get('/InsuranceExpenses', [App\Http\Controllers\InsuranceExpenses::class, 'index'])->name('InsuranceExpenses');
Route::get('/PrintingandPublicationExpenses', [App\Http\Controllers\PrintingandPublicationExpenses::class, 'index'])->name('PrintingandPublicationExpenses');
Route::get('/RepresentationExpenses', [App\Http\Controllers\RepresentationExpenses::class, 'index'])->name('RepresentationExpenses');
Route::get('/RentExpenses', [App\Http\Controllers\RentExpenses::class, 'index'])->name('RentExpenses');
Route::get('/MembershipDuesandContributiontoOrg', [App\Http\Controllers\MembershipDuesandContributiontoOrg::class, 'index'])->name('MembershipDuesandContributiontoOrg');
Route::get('/SubscriptionExpenses', [App\Http\Controllers\SubscriptionExpenses::class, 'index'])->name('SubscriptionExpenses');
Route::get('/OtherMaintenanceandOperatingExpenses', [App\Http\Controllers\OtherMaintenanceandOperatingExpenses::class, 'index'])->name('OtherMaintenanceandOperatingExpenses');
Route::get('/BankCharges', [App\Http\Controllers\BankCharges::class, 'index'])->name('BankCharges');
Route::get('/DepreciationBuildingandStructures', [App\Http\Controllers\DepreciationBuildingandStructures::class, 'index'])->name('DepreciationBuildingandStructures');
Route::get('/DepreciationMachineryandEquipment', [App\Http\Controllers\DepreciationMachineryandEquipment::class, 'index'])->name('DepreciationMachineryandEquipment');
Route::get('/DepreciationTransportationEquipment', [App\Http\Controllers\DepreciationTransportationEquipment::class, 'index'])->name('DepreciationTransportationEquipment');
Route::get('/DepreciationFurnituresandBooks', [App\Http\Controllers\DepreciationFurnituresandBooks::class, 'index'])->name('DepreciationFurnituresandBooks');

//ROUTES FOR ARCHIVED RECORDS
// FORMAT: Route::get('/CashLocalTreasuryArchived', [App\Http\Controllers\GeneralLedgerTrash::class, 'index'])->name('CashLocalTreasuryArchived');
Route::get('/CashLocalTreasuryArchived', [App\Http\Controllers\CashLocalTreasuryTrash::class, 'index'])->name('CashLocalTreasuryArchived');
Route::get('/PettyCashArchived', [App\Http\Controllers\PettyCashTrash::class, 'index'])->name('PettyCashArchived');
Route::get('/CashinBankLocalCurrencyCurrentAccountArchived', [App\Http\Controllers\CashinBankLocalCurrencyCurrentAccountTrash::class, 'index'])->name('CashinBankLocalCurrencyCurrentAccountArchived');
Route::get('/CashinBankLocalCurrencyTimeDepositsArchived', [App\Http\Controllers\CashinBankLocalCurrencyTimeDepositsTrash::class, 'index'])->name('CashinBankLocalCurrencyTimeDepositsArchived');
Route::get('/AccountsReceivableArchived', [App\Http\Controllers\AccountsReceivableTrash::class, 'index'])->name('AccountsReceivableArchived');
Route::get('/InterestsReceivableArchived', [App\Http\Controllers\InterestsReceivableTrash::class, 'index'])->name('InterestsReceivableArchived');
Route::get('/OfficeEquipmentArchived', [App\Http\Controllers\OfficeEquipmentTrash::class, 'index'])->name('OfficeEquipmentArchived');
Route::get('/AccumulatedDepreciationOfficeEquipmentArchived', [App\Http\Controllers\AccumulatedDepreciationOfficeEquipmentTrash::class, 'index'])->name('AccumulatedDepreciationOfficeEquipmentArchived');
Route::get('/InfoandCommunicationTechnologyEquipmentArchived', [App\Http\Controllers\InfoandCommunicationTechnologyEquipmentTrash::class, 'index'])->name('InfoandCommunicationTechnologyEquipmentArchived');
Route::get('/AccumulatedDepreciationICTEquipmentArchived', [App\Http\Controllers\AccumulatedDepreciationICTEquipmentTrash::class, 'index'])->name('AccumulatedDepreciationICTEquipmentArchived');
Route::get('/DisasterResponseandRescueEquipmentArchived', [App\Http\Controllers\DisasterResponseandRescueEquipmentTrash::class, 'index'])->name('DisasterResponseandRescueEquipmentArchived');
Route::get('/AccDepreciationDisasterResponseandRescueEquipmentArchived', [App\Http\Controllers\AccDepreciationDisasterResponseandRescueEquipmentTrash::class, 'index'])->name('AccDepreciationDisasterResponseandRescueEquipmentArchived');
Route::get('/MilitaryPoliceSecurityEquipmentArchived', [App\Http\Controllers\MilitaryPoliceSecurityEquipmentTrash::class, 'index'])->name('MilitaryPoliceSecurityEquipmentArchived');
Route::get('/AccDepreciationMilitaryPoliceSecurityEqpmntArchived', [App\Http\Controllers\AccDepreciationMilitaryPoliceSecurityEqpmntTrash::class, 'index'])->name('AccDepreciationMilitaryPoliceSecurityEqpmntArchived');
Route::get('/MedicalEquipmentArchived', [App\Http\Controllers\MedicalEquipmentTrash::class, 'index'])->name('MedicalEquipmentArchived');
Route::get('/AccumulatedDepreciationMedicalEquipmentArchived', [App\Http\Controllers\AccumulatedDepreciationMedicalEquipmentTrash::class, 'index'])->name('AccumulatedDepreciationMedicalEquipmentArchived');
Route::get('/SportsEquipmentArchived', [App\Http\Controllers\SportsEquipmentTrash::class, 'index'])->name('SportsEquipmentArchived');
Route::get('/AccumulatedDepreciationSportsEquipmentArchived', [App\Http\Controllers\AccumulatedDepreciationSportsEquipmentTrash::class, 'index'])->name('AccumulatedDepreciationSportsEquipmentArchived');
Route::get('/TechnicalandScientificEquipmentArchived', [App\Http\Controllers\TechnicalandScientificEquipmentTrash::class, 'index'])->name('TechnicalandScientificEquipmentArchived');
Route::get('/AccDepreciationTechnicalScientificEquipmentArchived', [App\Http\Controllers\AccDepreciationTechnicalScientificEquipmentTrash::class, 'index'])->name('AccDepreciationTechnicalScientificEquipmentArchived');
Route::get('/OtherMachineryEquipmentArchived', [App\Http\Controllers\OtherMachineryEquipmentTrash::class, 'index'])->name('OtherMachineryEquipmentArchived');
Route::get('/AccDepreciationOtherMachineryEquipmentArchived', [App\Http\Controllers\AccDepreciationOtherMachineryEquipmentTrash::class, 'index'])->name('AccDepreciationOtherMachineryEquipmentArchived');
Route::get('/GrantsDonationsinKindArchived', [App\Http\Controllers\GrantsDonationsinKindTrash::class, 'index'])->name('GrantsDonationsinKindArchived');
Route::get('/MiscellaneousIncomeArchived', [App\Http\Controllers\MiscellaneousIncomeTrash::class, 'index'])->name('MiscellaneousIncomeArchived');
Route::get('/SalariesandWagesRegularArchived', [App\Http\Controllers\SalariesandWagesRegularTrash::class, 'index'])->name('SalariesandWagesRegularArchived');
Route::get('/SalariesandWagesCasualContractualArchived', [App\Http\Controllers\SalariesandWagesCasualContractualTrash::class, 'index'])->name('SalariesandWagesCasualContractualArchived');
Route::get('/PersonnelEconomicReliefAllowanceArchived', [App\Http\Controllers\PersonnelEconomicReliefAllowanceTrash::class, 'index'])->name('PersonnelEconomicReliefAllowanceArchived');
Route::get('/RepresentationAllowanceArchived', [App\Http\Controllers\RepresentationAllowanceTrash::class, 'index'])->name('RepresentationAllowanceArchived');
Route::get('/TransportationAllowanceArchived', [App\Http\Controllers\TransportationAllowanceTrash::class, 'index'])->name('TransportationAllowanceArchived');
Route::get('/ClothingUniformAllowanceArchived', [App\Http\Controllers\ClothingUniformAllowanceTrash::class, 'index'])->name('ClothingUniformAllowanceArchived');
Route::get('/HonorariaArchived', [App\Http\Controllers\HonorariaTrash::class, 'index'])->name('HonorariaArchived');
Route::get('/HazardPayArchived', [App\Http\Controllers\HazardPayTrash::class, 'index'])->name('HazardPayArchived');
Route::get('/LongetivityPayArchived', [App\Http\Controllers\LongetivityPayTrash::class, 'index'])->name('LongetivityPayArchived');
Route::get('/OvertimeandNightPayArchived', [App\Http\Controllers\OvertimeandNightPayTrash::class, 'index'])->name('OvertimeandNightPayArchived');
Route::get('/YearEndBonusArchived', [App\Http\Controllers\YearEndBonusTrash::class, 'index'])->name('YearEndBonusArchived');
Route::get('/CashGiftArchived', [App\Http\Controllers\CashGiftTrash::class, 'index'])->name('CashGiftArchived');
Route::get('/RetirementandLifeInsurancePremiumsArchived', [App\Http\Controllers\RetirementandLifeInsurancePremiumsTrash::class, 'index'])->name('RetirementandLifeInsurancePremiumsArchived');
Route::get('/PagibigContributionsArchived', [App\Http\Controllers\PagibigContributionsTrash::class, 'index'])->name('PagibigContributionsArchived');
Route::get('/PhilHealthContributionsArchived', [App\Http\Controllers\PhilHealthContributionsTrash::class, 'index'])->name('PhilHealthContributionsArchived');
Route::get('/EmployeesCompensationInsurancePremiumsArchived', [App\Http\Controllers\EmployeesCompensationInsurancePremiumsTrash::class, 'index'])->name('EmployeesCompensationInsurancePremiumsArchived');
Route::get('/TerminalLeaveBenefitsArchived', [App\Http\Controllers\TerminalLeaveBenefitsTrash::class, 'index'])->name('TerminalLeaveBenefitsArchived');
Route::get('/OtherPersonnelBenefitsArchived', [App\Http\Controllers\OtherPersonnelBenefitsTrash::class, 'index'])->name('OtherPersonnelBenefitsArchived');
Route::get('/TravelingExpensesLocalArchived', [App\Http\Controllers\TravelingExpensesLocalTrash::class, 'index'])->name('TravelingExpensesLocalArchived');
Route::get('/TrainingExpensesArchived', [App\Http\Controllers\TrainingExpensesTrash::class, 'index'])->name('TrainingExpensesArchived');
Route::get('/OfficeSuppliesExpensesArchived', [App\Http\Controllers\OfficeSuppliesExpensesTrash::class, 'index'])->name('OfficeSuppliesExpensesArchived');
Route::get('/AccountableFormsExpensesArchived', [App\Http\Controllers\AccountableFormsExpensesTrash::class, 'index'])->name('AccountableFormsExpensesArchived');
Route::get('/DrugsandMedicinesExpensesArchived', [App\Http\Controllers\DrugsandMedicinesExpensesTrash::class, 'index'])->name('DrugsandMedicinesExpensesArchived');
Route::get('/MedicalDentalandLaboratorySuppliesExpensesArchived', [App\Http\Controllers\MedicalDentalandLaboratorySuppliesExpensesTrash::class, 'index'])->name('MedicalDentalandLaboratorySuppliesExpensesArchived');
Route::get('/FuelOilandLubricantsExpensesArchived', [App\Http\Controllers\FuelOilandLubricantsExpensesTrash::class, 'index'])->name('FuelOilandLubricantsExpensesArchived');
Route::get('/OtherSuppliesandMaterialsExpensesArchived', [App\Http\Controllers\OtherSuppliesandMaterialsExpensesTrash::class, 'index'])->name('OtherSuppliesandMaterialsExpensesArchived');
Route::get('/WaterExpensesArchived', [App\Http\Controllers\WaterExpensesTrash::class, 'index'])->name('WaterExpensesArchived');
Route::get('/ElectricityExpensesArchived', [App\Http\Controllers\ElectricityExpensesTrash::class, 'index'])->name('ElectricityExpensesArchived');
Route::get('/PostageandCourierServicesArchived', [App\Http\Controllers\PostageandCourierServicesTrash::class, 'index'])->name('PostageandCourierServicesArchived');
Route::get('/TelephoneExpensesArchived', [App\Http\Controllers\TelephoneExpensesTrash::class, 'index'])->name('TelephoneExpensesArchived');
Route::get('/InternetSubscriptionExpensesArchived', [App\Http\Controllers\InternetSubscriptionExpensesTrash::class, 'index'])->name('InternetSubscriptionExpensesArchived');
Route::get('/ExtraordinaryandMiscellaneousExpensesArchived', [App\Http\Controllers\ExtraordinaryandMiscellaneousExpensesTrash::class, 'index'])->name('ExtraordinaryandMiscellaneousExpensesArchived');
Route::get('/MotorVehiclesArchived', [App\Http\Controllers\MotorVehiclesTrash::class, 'index'])->name('MotorVehiclesArchived');
Route::get('/AccumulatedDepreciationMotorVehiclesArchived', [App\Http\Controllers\AccumulatedDepreciationMotorVehiclesTrash::class, 'index'])->name('AccumulatedDepreciationMotorVehiclesArchived');
Route::get('/FurnitureandFixturesArchived', [App\Http\Controllers\FurnitureandFixturesTrash::class, 'index'])->name('FurnitureandFixturesArchived');
Route::get('/AccumulatedDepreciationFurnitureandFixturesArchived', [App\Http\Controllers\AccumulatedDepreciationFurnitureandFixturesTrash::class, 'index'])->name('AccumulatedDepreciationFurnitureandFixturesArchived');
Route::get('/BuildingsandOtherStructuresArchived', [App\Http\Controllers\BuildingsandOtherStructuresTrash::class, 'index'])->name('BuildingsandOtherStructuresArchived');
Route::get('/AccountsPayableArchived', [App\Http\Controllers\AccountsPayableTrash::class, 'index'])->name('AccountsPayableArchived');
Route::get('/DuetoOfficersandEmployeesArchived', [App\Http\Controllers\DuetoOfficersandEmployeesTrash::class, 'index'])->name('DuetoOfficersandEmployeesArchived');
Route::get('/DuetoBIRArchived', [App\Http\Controllers\DuetoBIRTrash::class, 'index'])->name('DuetoBIRArchived');
Route::get('/DuetoGSISArchived', [App\Http\Controllers\DuetoGSISTrash::class, 'index'])->name('DuetoGSISArchived');
Route::get('/DuetoPAGIBIGArchived', [App\Http\Controllers\DuetoPAGIBIGTrash::class, 'index'])->name('DuetoPAGIBIGArchived');
Route::get('/DuetoPHILHEALTHArchived', [App\Http\Controllers\DuetoPHILHEALTHTrash::class, 'index'])->name('DuetoPHILHEALTHArchived');
Route::get('/TrustLiabilitiesArchived', [App\Http\Controllers\TrustLiabilitiesTrash::class, 'index'])->name('TrustLiabilitiesArchived');
Route::get('/GuarantySecurityDepositsPayableArchived', [App\Http\Controllers\GuarantySecurityDepositsPayableTrash::class, 'index'])->name('GuarantySecurityDepositsPayableArchived');
Route::get('/CustomersDepositArchived', [App\Http\Controllers\CustomersDepositTrash::class, 'index'])->name('CustomersDepositArchived');
Route::get('/OtherDeferredCreditsArchived', [App\Http\Controllers\OtherDeferredCreditsTrash::class, 'index'])->name('OtherDeferredCreditsArchived');
Route::get('/OtherPayablesArchived', [App\Http\Controllers\OtherPayablesTrash::class, 'index'])->name('OtherPayablesArchived');
Route::get('/GovernmentEquityArchived', [App\Http\Controllers\GovernmentEquityTrash::class, 'index'])->name('GovernmentEquityArchived');
Route::get('/PriorPeriodAdjustmentArchived', [App\Http\Controllers\PriorPeriodAdjustmentTrash::class, 'index'])->name('PriorPeriodAdjustmentArchived');
Route::get('/FinesandPenaltiesServiceIncomeArchived', [App\Http\Controllers\FinesandPenaltiesServiceIncomeTrash::class, 'index'])->name('FinesandPenaltiesServiceIncomeArchived');
Route::get('/SchoolFeesArchived', [App\Http\Controllers\SchoolFeesTrash::class, 'index'])->name('SchoolFeesArchived');
Route::get('/AffiliationFeesArchived', [App\Http\Controllers\AffiliationFeesTrash::class, 'index'])->name('AffiliationFeesArchived');
Route::get('/RentIncomeArchived', [App\Http\Controllers\RentIncomeTrash::class, 'index'])->name('RentIncomeArchived');
Route::get('/InterestIncomeArchived', [App\Http\Controllers\InterestIncomeTrash::class, 'index'])->name('InterestIncomeArchived');
Route::get('/OtherBusinessIncomeArchived', [App\Http\Controllers\OtherBusinessIncomeTrash::class, 'index'])->name('OtherBusinessIncomeArchived');
Route::get('/SubsidyfromLGUsArchived', [App\Http\Controllers\SubsidyfromLGUsTrash::class, 'index'])->name('SubsidyfromLGUsArchived');
Route::get('/OtherProfessionalServicesArchived', [App\Http\Controllers\OtherProfessionalServicesTrash::class, 'index'])->name('OtherProfessionalServicesArchived');
Route::get('/RepairsandMaintBuildingOtherStructuresArchived', [App\Http\Controllers\RepairsandMaintBuildingOtherStructuresTrash::class, 'index'])->name('RepairsandMaintBuildingOtherStructuresArchived');
Route::get('/RepairsandMaintMachineryandEquipmentArchived', [App\Http\Controllers\RepairsandMaintMachineryandEquipmentTrash::class, 'index'])->name('RepairsandMaintMachineryandEquipmentArchived');
Route::get('/RepairsandMaintTransportationEquipmentArchived', [App\Http\Controllers\RepairsandMaintTransportationEquipmentTrash::class, 'index'])->name('RepairsandMaintTransportationEquipmentArchived');
Route::get('/FidelityBondPremiumsArchived', [App\Http\Controllers\FidelityBondPremiumsTrash::class, 'index'])->name('FidelityBondPremiumsArchived');
Route::get('/InsuranceExpensesArchived', [App\Http\Controllers\InsuranceExpensesTrash::class, 'index'])->name('InsuranceExpensesArchived');
Route::get('/PrintingandPublicationExpensesArchived', [App\Http\Controllers\PrintingandPublicationExpensesTrash::class, 'index'])->name('PrintingandPublicationExpensesArchived');
Route::get('/RepresentationExpensesArchived', [App\Http\Controllers\RepresentationExpensesTrash::class, 'index'])->name('RepresentationExpensesArchived');
Route::get('/RentExpensesArchived', [App\Http\Controllers\RentExpensesTrash::class, 'index'])->name('RentExpensesArchived');
Route::get('/MembershipDuesandContributiontoOrgArchived', [App\Http\Controllers\MembershipDuesandContributiontoOrgTrash::class, 'index'])->name('MembershipDuesandContributiontoOrgArchived');
Route::get('/SubscriptionExpensesArchived', [App\Http\Controllers\SubscriptionExpensesTrash::class, 'index'])->name('SubscriptionExpensesArchived');
Route::get('/OtherMaintenanceandOperatingExpensesArchived', [App\Http\Controllers\OtherMaintenanceandOperatingExpensesTrash::class, 'index'])->name('OtherMaintenanceandOperatingExpensesArchived');
Route::get('/BankChargesArchived', [App\Http\Controllers\BankChargesTrash::class, 'index'])->name('BankChargesArchived');
Route::get('/DepreciationBuildingandStructuresArchived', [App\Http\Controllers\DepreciationBuildingandStructuresTrash::class, 'index'])->name('DepreciationBuildingandStructuresArchived');
Route::get('/DepreciationMachineryandEquipmentArchived', [App\Http\Controllers\DepreciationMachineryandEquipmentTrash::class, 'index'])->name('DepreciationMachineryandEquipmentArchived');
Route::get('/DepreciationTransportationEquipmentArchived', [App\Http\Controllers\DepreciationTransportationEquipmentTrash::class, 'index'])->name('DepreciationTransportationEquipmentArchived');
Route::get('/DepreciationFurnituresandBooksArchived', [App\Http\Controllers\DepreciationFurnituresandBooksTrash::class, 'index'])->name('DepreciationFurnituresandBooksArchived');


Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

Route::get('/settings', function () {
    return view('sidebarlinks.settings');
});



  



