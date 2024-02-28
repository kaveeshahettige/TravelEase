<?php

class Businessmanager extends Controller{

    private $postModel;
    public function __construct()
    {
        // $this->userModel = $this->model('Travel');
        if(!isLoggedIn()){
            redirect('users/login');
          }
        $this->BusinessmanagersModel = $this->model('Businessmanagers');
    }

    public function index(){
        $this->view('businessmanager/index');
    }
    public function addpackage(){
        $this->view('businessmanager/addpackage');
    }
    public function bookings(){
        $bookingData = $this->getBookings();
              $data = [
                'bookingData' => $bookingData
            ];
//              var_dump($data);
            $this->view('businessmanager/bookings', $data);

    }
    public function notifications(){
        $this->view('businessmanager/notifications');
    }
    public function businessmanageredit(){
        $this->view('businessmanager/businessmanageredit');
    }
    public function businessmanagerpassword(){
        $this->view('businessmanager/businessmanagerpassword');
    }
    public function financialmanagement(){
        $transactionData = $this->getTransactions();
              $data = [
                'transactionData' => $transactionData
            ];
//              var_dump($data);
        $this->view('businessmanager/financialmanagement', $data);
    }
    public function packageedit(){
        $this->view('businessmanager/packageedit');
    }
    public function packages(){
        $packageData = $this->getPackages();
              $data = [
                'packageData' => $packageData
            ];
//              var_dump($data);
        $this->view('businessmanager/packages', $data);
    }   public function reports(){
        $this->view('businessmanager/reports');
    }
    public function settings(){
        $this->view('businessmanager/settings');
    }
    public function navigation(){
        $this->view('businessmanager/navigation');
    }


    public function getBookings()
    {
        $bookingData = $this->BusinessmanagersModel->getBookings();

        if ($bookingData) {
            return $bookingData;
        } else {
            return [];
        }
    }

    public function getPackages()
    {
        $packageData = $this->BusinessmanagersModel->getPackages();

        if ($packageData) {
            return $packageData;
        } else {
            return [];
        }
    }

    public function getTransactions()
    {
        $transactionData = $this->BusinessmanagersModel->getTransactions();

        if ($transactionData) {
            return $transactionData;
        } else {
            return [];
        }
    }

    public function generateReport()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $serviceType = $_POST['serviceType'];
            $reportType = $_POST['reportType'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $this->BusinessmanagersModel->generateReport($serviceType, $reportType, $startDate, $endDate);
        }


    }

    public function generatePDFReport($serviceType, $startDate, $endDate)
    {
        $reportData = $this->BusinessmanagersModel->generateReport($serviceType, $startDate, $endDate);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Report');

        foreach ($reportData as $report) {
            $pdf->Cell(40, 10, $report['time_range']);
            $pdf->Cell(40, 10, $report['service_type']);
            $pdf->Cell(40, 10, $report['service_provider_name']);
            $pdf->Cell(40, 10, $report['report_type']);
        }

        $pdf->Output();
    }




}