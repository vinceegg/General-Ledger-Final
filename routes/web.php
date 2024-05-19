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
Route::get('/InterestsReceivable', [App\Http\Controllers\InterestsReceivableController::class, 'index'])->name('InterestsReceivable');
Route::get('/OfficeEquipment', [App\Http\Controllers\OfficeEquipmentController::class, 'index'])->name('OfficeEquipment');
Route::get('/AccumulatedDepreciationOfficeEquipment', [App\Http\Controllers\AccumulatedDepreciationOfficeEquipmentController::class, 'index'])->name('AccumulatedDepreciationOfficeEquipment');
Route::get('/InfoandCommunicationTechnologyEquipment', [App\Http\Controllers\InfoandCommunicationTechnologyEquipmentController::class, 'index'])->name('InfoandCommunicationTechnologyEquipment');
Route::get('/AccumulatedDepreciationICTEquipment', [App\Http\Controllers\AccumulatedDepreciationICTEquipmentController::class, 'index'])->name('AccumulatedDepreciationICTEquipment');
Route::get('/DisasterResponseandRescueEquipment', [App\Http\Controllers\DisasterResponseandRescueEquipmentController::class, 'index'])->name('DisasterResponseandRescueEquipment');
Route::get('/AccDepreciationDisasterResponseandRescueEquipment', [App\Http\Controllers\AccDepreciationDisasterResponseandRescueEquipmentController::class, 'index'])->name('AccDepreciationDisasterResponseandRescueEquipment');
Route::get('/MilitaryPoliceSecurityEquipment', [App\Http\Controllers\MilitaryPoliceSecurityEquipmentController::class, 'index'])->name('MilitaryPoliceSecurityEquipment');
Route::get('/AccDepreciationMilitaryPoliceSecurityEqpmnt', [App\Http\Controllers\AccDepreciationMilitaryPoliceSecurityEqpmntController::class, 'index'])->name('AccDepreciationMilitaryPoliceSecurityEqpmnt');
Route::get('/MedicalEquipment', [App\Http\Controllers\MedicalEquipmentController::class, 'index'])->name('MedicalEquipment');
Route::get('/AccumulatedDepreciationMedicalEquipment', [App\Http\Controllers\AccumulatedDepreciationMedicalEquipmentController::class, 'index'])->name('AccumulatedDepreciationMedicalEquipment');
Route::get('/SportsEquipment', [App\Http\Controllers\SportsEquipmentController::class, 'index'])->name('SportsEquipment');
Route::get('/AccumulatedDepreciationSportsEquipment', [App\Http\Controllers\AccumulatedDepreciationSportsEquipmentController::class, 'index'])->name('AccumulatedDepreciationSportsEquipment');
Route::get('/TechnicalandScientificEquipment', [App\Http\Controllers\TechnicalandScientificEquipmentController::class, 'index'])->name('TechnicalandScientificEquipment');
Route::get('/AccDepreciationTechnicalScientificEquipment', [App\Http\Controllers\AccDepreciationTechnicalScientificEquipmentController::class, 'index'])->name('AccDepreciationTechnicalScientificEquipment');
Route::get('/OtherMachineryEquipment', [App\Http\Controllers\OtherMachineryEquipmentController::class, 'index'])->name('OtherMachineryEquipment');
Route::get('/AccDepreciationOtherMachineryEquipment', [App\Http\Controllers\AccDepreciationOtherMachineryEquipmentController::class, 'index'])->name('AccDepreciationOtherMachineryEquipment');
Route::get('/GrantsDonationsinKind', [App\Http\Controllers\GrantsDonationsinKindController::class, 'index'])->name('GrantsDonationsinKind');
Route::get('/MiscellaneousIncome', [App\Http\Controllers\MiscellaneousIncomeController::class, 'index'])->name('MiscellaneousIncome');
Route::get('/SalariesandWagesRegular', [App\Http\Controllers\SalariesandWagesRegularController::class, 'index'])->name('SalariesandWagesRegular');
Route::get('/SalariesandWagesCasualContractual', [App\Http\Controllers\SalariesandWagesCasualContractualController::class, 'index'])->name('SalariesandWagesCasualContractual');
Route::get('/PersonnelEconomicReliefAllowance', [App\Http\Controllers\PersonnelEconomicReliefAllowanceController::class, 'index'])->name('PersonnelEconomicReliefAllowance');
Route::get('/RepresentationAllowance', [App\Http\Controllers\RepresentationAllowanceController::class, 'index'])->name('RepresentationAllowance');
Route::get('/TransportationAllowance', [App\Http\Controllers\TransportationAllowanceController::class, 'index'])->name('TransportationAllowance');
Route::get('/ClothingUniformAllowance', [App\Http\Controllers\ClothingUniformAllowanceController::class, 'index'])->name('ClothingUniformAllowance');
Route::get('/Honoraria', [App\Http\Controllers\HonorariaController::class, 'index'])->name('Honoraria');
Route::get('/HazardPay', [App\Http\Controllers\HazardPayController::class, 'index'])->name('HazardPay');
Route::get('/LongetivityPay', [App\Http\Controllers\LongetivityPayController::class, 'index'])->name('LongetivityPay');
Route::get('/OvertimeandNightPay', [App\Http\Controllers\OvertimeandNightPayController::class, 'index'])->name('OvertimeandNightPay');
Route::get('/YearEndBonus', [App\Http\Controllers\YearEndBonusController::class, 'index'])->name('YearEndBonus');
Route::get('/CashGift', [App\Http\Controllers\CashGiftController::class, 'index'])->name('CashGift');
Route::get('/RetirementandLifeInsurancePremiums', [App\Http\Controllers\RetirementandLifeInsurancePremiumsController::class, 'index'])->name('RetirementandLifeInsurancePremiums');
Route::get('/PagibigContributions', [App\Http\Controllers\PagibigContributionsController::class, 'index'])->name('PagibigContributions');
Route::get('/PhilHealthContributions', [App\Http\Controllers\PhilHealthContributionsController::class, 'index'])->name('PhilHealthContributions');
Route::get('/EmployeesCompensationInsurancePremiums', [App\Http\Controllers\EmployeesCompensationInsurancePremiumsController::class, 'index'])->name('EmployeesCompensationInsurancePremiums');
Route::get('/TerminalLeaveBenefits', [App\Http\Controllers\TerminalLeaveBenefitsController::class, 'index'])->name('TerminalLeaveBenefits');
Route::get('/OtherPersonnelBenefits', [App\Http\Controllers\OtherPersonnelBenefitsController::class, 'index'])->name('OtherPersonnelBenefits');
Route::get('/TravelingExpensesLocal', [App\Http\Controllers\TravelingExpensesLocalController::class, 'index'])->name('TravelingExpensesLocal');
Route::get('/TrainingExpenses', [App\Http\Controllers\TrainingExpensesController::class, 'index'])->name('TrainingExpenses');
Route::get('/OfficeSuppliesExpenses', [App\Http\Controllers\OfficeSuppliesExpensesController::class, 'index'])->name('OfficeSuppliesExpenses');
Route::get('/AccountableFormsExpenses', [App\Http\Controllers\AccountableFormsExpensesController::class, 'index'])->name('AccountableFormsExpenses');
Route::get('/DrugsandMedicinesExpenses', [App\Http\Controllers\DrugsandMedicinesExpensesController::class, 'index'])->name('DrugsandMedicinesExpenses');
Route::get('/MedicalDentalandLaboratorySuppliesExpenses', [App\Http\Controllers\MedicalDentalandLaboratorySuppliesExpensesController::class, 'index'])->name('MedicalDentalandLaboratorySuppliesExpenses');
Route::get('/FuelOilandLubricantsExpenses', [App\Http\Controllers\FuelOilandLubricantsExpensesController::class, 'index'])->name('FuelOilandLubricantsExpenses');
Route::get('/OtherSuppliesandMaterialsExpenses', [App\Http\Controllers\OtherSuppliesandMaterialsExpensesController::class, 'index'])->name('OtherSuppliesandMaterialsExpenses');
Route::get('/WaterExpenses', [App\Http\Controllers\WaterExpensesController::class, 'index'])->name('WaterExpenses');
Route::get('/ElectricityExpenses', [App\Http\Controllers\ElectricityExpensesController::class, 'index'])->name('ElectricityExpenses');
Route::get('/PostageandCourierServices', [App\Http\Controllers\PostageandCourierServicesController::class, 'index'])->name('PostageandCourierServices');
Route::get('/TelephoneExpenses', [App\Http\Controllers\TelephoneExpensesController::class, 'index'])->name('TelephoneExpenses');
Route::get('/InternetSubscriptionExpenses', [App\Http\Controllers\InternetSubscriptionExpensesController::class, 'index'])->name('InternetSubscriptionExpenses');
Route::get('/ExtraordinaryandMiscellaneousExpenses', [App\Http\Controllers\ExtraordinaryandMiscellaneousExpensesController::class, 'index'])->name('ExtraordinaryandMiscellaneousExpenses');
Route::get('/MotorVehicles', [App\Http\Controllers\MotorVehiclesController::class, 'index'])->name('MotorVehicles');
Route::get('/AccumulatedDepreciationMotorVehicles', [App\Http\Controllers\AccumulatedDepreciationMotorVehiclesController::class, 'index'])->name('AccumulatedDepreciationMotorVehicles');
Route::get('/FurnitureandFixtures', [App\Http\Controllers\FurnitureandFixturesController::class, 'index'])->name('FurnitureandFixtures');
Route::get('/AccumulatedDepreciationFurnitureandFixtures', [App\Http\Controllers\AccumulatedDepreciationFurnitureandFixturesController::class, 'index'])->name('AccumulatedDepreciationFurnitureandFixtures');
Route::get('/BuildingsandOtherStructures', [App\Http\Controllers\BuildingsandOtherStructuresController::class, 'index'])->name('BuildingsandOtherStructures');
Route::get('/AccountsPayable', [App\Http\Controllers\AccountsPayableController::class, 'index'])->name('AccountsPayable');
Route::get('/DuetoOfficersandEmployees', [App\Http\Controllers\DuetoOfficersandEmployeesController::class, 'index'])->name('DuetoOfficersandEmployees');
Route::get('/DuetoBIR', [App\Http\Controllers\DuetoBIRController::class, 'index'])->name('DuetoBIR');
Route::get('/DuetoGSIS', [App\Http\Controllers\DuetoGSISController::class, 'index'])->name('DuetoGSIS');
Route::get('/DuetoPAGIBIG', [App\Http\Controllers\DuetoPAGIBIGController::class, 'index'])->name('DuetoPAGIBIG');
Route::get('/DuetoPHILHEALTH', [App\Http\Controllers\DuetoPHILHEALTHController::class, 'index'])->name('DuetoPHILHEALTH');
Route::get('/TrustLiabilities', [App\Http\Controllers\TrustLiabilitiesController::class, 'index'])->name('TrustLiabilities');
Route::get('/GuarantySecurityDepositsPayable', [App\Http\Controllers\GuarantySecurityDepositsPayableController::class, 'index'])->name('GuarantySecurityDepositsPayable');
Route::get('/CustomersDeposit', [App\Http\Controllers\CustomersDepositController::class, 'index'])->name('CustomersDeposit');
Route::get('/OtherDeferredCredits', [App\Http\Controllers\OtherDeferredCreditsController::class, 'index'])->name('OtherDeferredCredits');
Route::get('/OtherPayables', [App\Http\Controllers\OtherPayablesController::class, 'index'])->name('OtherPayables');
Route::get('/GovernmentEquity', [App\Http\Controllers\GovernmentEquityController::class, 'index'])->name('GovernmentEquity');
Route::get('/PriorPeriodAdjustment', [App\Http\Controllers\PriorPeriodAdjustmentController::class, 'index'])->name('PriorPeriodAdjustment');
Route::get('/FinesandPenaltiesServiceIncome', [App\Http\Controllers\FinesandPenaltiesServiceIncomeController::class, 'index'])->name('FinesandPenaltiesServiceIncome');
Route::get('/SchoolFees', [App\Http\Controllers\SchoolFeesController::class, 'index'])->name('SchoolFees');
Route::get('/AffiliationFees', [App\Http\Controllers\AffiliationFeesController::class, 'index'])->name('AffiliationFees');
Route::get('/RentIncome', [App\Http\Controllers\RentIncomeController::class, 'index'])->name('RentIncome');
Route::get('/InterestIncome', [App\Http\Controllers\InterestIncomeController::class, 'index'])->name('InterestIncome');
Route::get('/OtherBusinessIncome', [App\Http\Controllers\OtherBusinessIncomeController::class, 'index'])->name('OtherBusinessIncome');
Route::get('/SubsidyfromLGUs', [App\Http\Controllers\SubsidyfromLGUsController::class, 'index'])->name('SubsidyfromLGUs');
Route::get('/OtherProfessionalServices', [App\Http\Controllers\OtherProfessionalServicesController::class, 'index'])->name('OtherProfessionalServices');
Route::get('/RepairsandMaintBuildingOtherStructures', [App\Http\Controllers\RepairsandMaintBuildingOtherStructuresController::class, 'index'])->name('RepairsandMaintBuildingOtherStructures');
Route::get('/RepairsandMaintMachineryandEquipment', [App\Http\Controllers\RepairsandMaintMachineryandEquipmentController::class, 'index'])->name('RepairsandMaintMachineryandEquipment');
Route::get('/RepairsandMaintTransportationEquipment', [App\Http\Controllers\RepairsandMaintTransportationEquipmentController::class, 'index'])->name('RepairsandMaintTransportationEquipment');
Route::get('/FidelityBondPremiums', [App\Http\Controllers\FidelityBondPremiumsController::class, 'index'])->name('FidelityBondPremiums');
Route::get('/InsuranceExpenses', [App\Http\Controllers\InsuranceExpensesController::class, 'index'])->name('InsuranceExpenses');
Route::get('/PrintingandPublicationExpenses', [App\Http\Controllers\PrintingandPublicationExpensesController::class, 'index'])->name('PrintingandPublicationExpenses');
Route::get('/RepresentationExpenses', [App\Http\Controllers\RepresentationExpensesController::class, 'index'])->name('RepresentationExpenses');
Route::get('/RentExpenses', [App\Http\Controllers\RentExpensesController::class, 'index'])->name('RentExpenses');
Route::get('/MembershipDuesandContributiontoOrg', [App\Http\Controllers\MembershipDuesandContributiontoOrgController::class, 'index'])->name('MembershipDuesandContributiontoOrg');
Route::get('/SubscriptionExpenses', [App\Http\Controllers\SubscriptionExpensesController::class, 'index'])->name('SubscriptionExpenses');
Route::get('/OtherMaintenanceandOperatingExpenses', [App\Http\Controllers\OtherMaintenanceandOperatingExpensesController::class, 'index'])->name('OtherMaintenanceandOperatingExpenses');
Route::get('/BankCharges', [App\Http\Controllers\BankChargesController::class, 'index'])->name('BankCharges');
Route::get('/DepreciationBuildingandStructures', [App\Http\Controllers\DepreciationBuildingandStructuresController::class, 'index'])->name('DepreciationBuildingandStructures');
Route::get('/DepreciationMachineryandEquipment', [App\Http\Controllers\DepreciationMachineryandEquipmentController::class, 'index'])->name('DepreciationMachineryandEquipment');
Route::get('/DepreciationTransportationEquipment', [App\Http\Controllers\DepreciationTransportationEquipmentController::class, 'index'])->name('DepreciationTransportationEquipment');
Route::get('/DepreciationFurnituresandBooks', [App\Http\Controllers\DepreciationFurnituresandBooksController::class, 'index'])->name('DepreciationFurnituresandBooks');

Route::get('/faqs', function () {
    return view('sidebarlinks.faqs');
});

Route::get('/settings', function () {
    return view('sidebarlinks.settings');
});



  



