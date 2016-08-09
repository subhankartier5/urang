@extends('invoices.layouts.master')
@section('content')
<style>
.custom-table table{width: 100%;}
.custom-table table tr td:nth-child(2){text-align: left;}
.custom-table table tr td:nth-child(3){text-align: right;}
</style>
<div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{url('/')}}/public/images/logo_invoice.png" style="width:100%; max-width:300px;">
                            </td>
                            <div style="display: none;">
                                <?php
                                    $one_iteraion = "";
                                ?>
                                @foreach($search_invoice as $invoice)
                                    {{$one_iteration = $invoice}}
                                @endforeach
                            </div>
                            <td>
                                Invoice #: {{$one_iteration->invoice_id}}<br>
                                Date: {{date("F jS Y",strtotime($one_iteration->created_at->toDateString()))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <label>To,</label>
                            <td>
                                {{$one_iteration->user_details->name}}<br>
                                {{$one_iteration->user->email}}<br>
                                {{$one_iteration->user_details->address}}
                            </td>
                            <td>
                                <label>From,</label><br>
                                Urang.com<br>
                                Email us: support@urang.com<br>
                                Call us: 85858558585 <br>
                                Payment Status: {{$one_iteration->pick_up_req->payment_status == 1 ? "Paid" : "Pending"}} <br>
                                @if($one_iteration->user_details->payment_status == 1)
                                    Paid At: {{date("F jS Y",strtotime($one_iteration->updated_at->toDateString()))}}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Coupon #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    <?php
                        switch ($one_iteration->pick_up_req->payment_type) {
                            case '1':
                                echo "Card";
                                break;
                            case '2':
                                echo "Cash On Delivary";
                                break;
                            case '3':
                                echo "Check Payment";
                                break;   
                            default:
                                echo "Error! Not able to understand payment method";
                                break;
                        }
                    ?>
                </td>
                
                <td>
                    {{$one_iteration->pick_up_req->coupon != null ? $one_iteration->pick_up_req->coupon: "No Coupon Applied" }}
                </td>
            </tr>
            <tr>
            <td colspan="3">
            <div class="custom-table">
            <table>
                <tr class="heading">
                    <td style="width: 30%">
                        Item
                    </td>
                    <td style="width: 30%">
                        Quantity
                    </td>
                    <td style="width: 30%">
                        Price 
                    </td>
                </tr>
            <div style="display: none;">
                {{$total_price = 0.00}}
            </div>
            @foreach($search_invoice as $invoice)
                <tr class="item">
                    <td>{{$invoice->item}}</td>
                    <td>{{$invoice->quantity}}</td>
                    <td>${{number_format((float)$invoice->price, 2, '.', '')}}</td>
                </tr>
                <div style="display: none;">
                    {{$total_price += floatval($invoice->quantity*$invoice->price)}}
                </div> 
            @endforeach
            </table>
            </div>
            </td>    
            </tr>
            @if(count($school_details) > 0)
                <tr class="heading">
                    <td>
                        School Name
                    </td>
                    <td>
                        Donated Money 
                    </td>
                </tr>
                <tr class="details">
                    <td>{{$school_details->school_name}}</td>
                    <td>{{($total_price*$school_donation_per->percentage)/100}}</td>
                </tr>
            @endif
            <tr class="total">
                <td></td>
                
                <td>
                    <?php $school_donation_money = $total_price;  ?>
                   Total: ${{$total_price}}
                </td>
            </tr>
        </table>
    </div>
@endsection