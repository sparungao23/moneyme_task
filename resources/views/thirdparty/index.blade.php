@extends('layouts.mainlayout')
@section('content')
<div class="container">
      <div class="py-5 text-center">
        <h2>Third Party Website</h2>
      </div>
      <div class="card border-info">
        <div class="card-body">  
      <div class="row">
        <div class="col-md-12 order-md-1">
          <form action="{{url('third-party')}}" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="title">Title</label>
                    <select name="Title" id="Title" class="form-control">
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                    </select>
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" name="FirstName" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" name="LastName" id="lastName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="Email" id="email" placeholder="sonny@gmail.com" required>
                    <div class="invalid-feedback">
                    Please enter a valid email address
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobile-number">Mobile Number</label>
                    <input type="text" class="form-control" name="Mobile" id="mobile-number" placeholder="" required>
                    <div class="invalid-feedback">
                    Mobile number is required
                    </div>    
                </div>    
            </div>
           
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="required-amount">Amount Required</label>
                    <input type="number" min="0" class="form-control" name="AmountRequired" id="amount-required" placeholder="" required>
                    <div class="invalid-feedback">
                    Required Amount is required
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="term">Term</label>
                    <input type="number" min="0" class="form-control" name="Term" id="term" placeholder="" required>
                    <div class="invalid-feedback">
                    Term is required
                    </div>    
                </div>    
            </div>
            <small><b>Note:</b> This form will consume the API and will redirect the user to momeyme website.</small> <br />

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
          </form>
        </div>
      </div>
     </div>
      </div>
</div>
@endsection
