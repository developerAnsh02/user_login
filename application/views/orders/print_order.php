<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data         = explode('?', $current_page);
$role_id      = $this->session->userdata['logged_in']['role_id'];
$url          = current_url();
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?= $title ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="card-body">
            <div class="invoice p-3 mb-3">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <img src="<?= base_url() ?>/uploads/assignment_logo.png" height="150" width="200" />
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <h3 style="padding-top: 20px;"> Assignment In Need </h3>
                    </div>
                    <div class="col-sm-4 invoice-col" style="display: none;">
                        <strong><u>Company Details:</u></strong><br>
                        <b>GSTIN : </b>08AABFC2155P1ZA<br>
                        <b>PAN : </b> AABFC2155P<br>
                        <b> Address : </b> Sector 6 ,Madri, Udaipur, Rajasthan 313003.
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="6">
                                        <h4 style="text-align: center">Order details : </h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th> Order ID : </th>
                                    <td> <?= $current['0']['order_id'] ?> </td>
                                    <th> Order Date : </th>
                                    <td> <?= date('d-m-Y', strtotime($current['0']['order_date'])) ?> </td>
                                </tr>
                                <tr>
                                    <th> Customer Name : </th>
                                    <td> <?= $current['0']['c_name'] ?> </td>
                                    <th> Email : </th>
                                    <td> <?= $current['0']['c_email'] ?> </td>
                                </tr>
                                <tr>
                                    <th> Mobile Number : </th>
                                    <td> <?= '+' . $current['0']['countrycode'] . ' - ' . $current['0']['c_mobile'] ?> </td>
                                    <th> Message : </th>
                                    <td> <?= $current['0']['message'] ?> </td>
                                </tr>
                                <tr>
                                    <th> Type Of Service: </th>
                                    <td> <?= $current['0']['services'] ?> </td>
                                    <th> Formatting:</th>
                                    <td> <?= $current['0']['formatting'] ?> </td>
                                </tr>
                                <tr>
                                    <th> Type Of Paper : </th>
                                    <td> <?= $current['0']['typeofpaper'] ?> </td>
                                    <th> Type Of Writting : </th>
                                    <td> <?= $current['0']['typeofwritting'] ?> </td>
                                </tr>
                                <tr>
                                    <th> Pages : </th>
                                    <td> <?= $current['0']['pages'] ?> </td>
                                    <th> Number Of Sources : </th>
                                    <td> <?php if(isset($current['0']['numberofsources']) && !empty($current['0']['numberofsources'])) { echo $current['0']['numberofsources']; } ?> </td>
                                </tr>
                                <tr>
                                    <th> Deadline : </th>
                                    <td> <?= $current['0']['deadline'] ?> </td>
                                    <th> Actual : </th>
                                    <td> <?= $current['0']['actual_amount'] ?> </td>
                                </tr>
                                <tr>
                                    <th> Discount % : </th>
                                    <td> <?= $current['0']['discount_per'] ?> </td>
                                    <th> Payable Amount : </th>
                                    <td> <?= $current['0']['amount'] ?> </td>
                                </tr>
                                <tr>
                                    <td colspan="4"> <br></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b> Declaration : </b> We declare that this copy shows the actual information of this supplier and that all particulars are true and correct to the best of our knowledge.
                    </div>
                    <div class="col-sm-4 invoice-col">
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <strong><u>For Assignment In Need :</u></strong>
                        <br></br><br></br>
                        <b>( Authorised Signatory)</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->

<script src="<?php echo base_url(); ?>assets/node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        moneyFormat(x) 
        {
            x = x.toString();
            var lastThree = x.substring(x.length - 3);
            var otherNumbers = x.substring(0, x.length - 3);
            if (otherNumbers != '')
                lastThree = ',' + lastThree;
            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        }
    });
</script>