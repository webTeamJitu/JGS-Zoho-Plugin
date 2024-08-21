<?php
function form() {
    echo 'asas';
$form = "
<div class='appcontainer'>
    <header>Jitu Staffing Job Application Form</header>
    <div class='progress-bar'>
      <div class='step'>
        <p>Basic Info:</p>
        <div class='bullet'>
          <span>1</span>
        </div>
        <div class='check fas fa-check'></div>
      </div>
      <div class='step'>
        <p>Role</p>
        <div class='bullet'>
          <span>2</span>
        </div>
        <div class='check fas fa-check'></div>
      </div>
      <div class='step'>
        <p>Audio Interview</p>
        <div class='bullet'>
          <span>3</span>
        </div>
        <div class='check fas fa-check'></div>
      </div>
      <div class='step'>
        <p>Resume and Certification</p>
        <div class='bullet'>
          <span>4</span>
        </div>
        <div class='check fas fa-check'></div>
      </div>
    </div>
    <div class='form-outer'>
      <form action='https://forms.zohopublic.com/markallen/form/THEJituGlobalStaffingApplicationForm/formperma/HCELz0ATaZrXkpAkFce0s_g99YnQ9uX93QNKhXsCmZg/htmlRecords/submit' name='form' id='form' method='POST' accept-charset='UTF-8' enctype='multipart/form-data'>
        <input type='hidden' name='zf_referrer_name' value=''><!-- To Track referrals , place the referrer name within the ' ' in the above hidden input field -->
        <input type='hidden' name='zf_redirect_url' value=''><!-- To redirect to a specific page after record submission , place the respective url within the ' ' in the above hidden input field -->
        <input type='hidden' name='zc_gad' value=''><!-- If GCLID is enabled in Zoho CRM Integration, click details of AdWords Ads will be pushed to Zoho CRM -->


        <div class='page slide-page'>
          <div class='title'>Basic Info:</div>
          <div class='field'>
            <div class='label'>First Name <span style='color:red'>*</span></div>
            <input type='text' maxlength='255' name='Name_First' fieldType=7 placeholder='John' />
          </div>
          <div class='field'>
            <div class='label'>Last Name <span style='color:red'>*</span></div>
            <input type='text' maxlength='255' name='Name_Last' fieldType=7 placeholder='Doe' />
          </div>
          <div class='field'>
            <div class='label'>Phone Number <span style='color:red'>*</span></div>
            <input type='text' compname='PhoneNumber' name='PhoneNumber_countrycode'
            maxlength='20' checktype='c7' value='' phoneFormat='1'
            isCountryCodeEnabled=false fieldType='11'
            id='international_PhoneNumber_countrycode' valType='number'
            phoneFormatType='2' placeholder='&#x2b;254&#x20;701&#x20;234&#x20;567' />
          </div>
          <div class='field'>
            <div class='label'>Email Address <span style='color:red'>*</span></div>
            <input fieldType=9 type='text' maxlength='255' name='Email' checktype='c5' value='' placeholder='johndoe&#x40;jitustaffing.com' />
          </div>

          <div class='field'>
            <div class='label'>How did you hear about us ? <span style='color:red'>*</span></div>
            <select class='zf-form-sBox' name='Dropdown' checktype='c1'>
              <option selected='true' value='-Select-'>Select</option>
              <option value='University'>University</option>
              <option value='Teach2Give'>Teach2Give</option>
              <option value='Referral'>Referral</option>
              <option value='Job&#x20;Board'>Job Board</option>
              <option value='Friends&#x2f;Family'>Friends&#x2f;Family</option>
            </select>
          </div>

          <div class='field'>
            <button class='firstNext next'>Next</button>
          </div>
        </div>

        <div class='page'>
          <div class='title'>Role Application Info:<span style='color:red'>*</span></div>
          <div class='field flexer'>
            
            <p class='title'>We are based in Nyeri, Kenya. Our roles require you to work from our Nyeri
              office locations. The open positions all have different shift requirement
              that are specified by the client.<br/> Please choose the role you are applying for below.</p>
            <div class='zf-tempContDiv'>
              <div class='zf-overflow'>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_1' name='Dropdown1'
                          checktype='c1'
                          value='Business&#x20;Process&#x20;Support&#x20;-Gross&#x20;Salary&#x20;Kes&#x20;24,000'>
                      <label for='Dropdown1_1'
                          class='zf-radioChoice'>Business&#x20;Process&#x20;Support&#x20;-Gross&#x20;Salary&#x20;Kes&#x20;24,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_2' name='Dropdown1'
                          checktype='c1'
                          value='Certified&#x20;Salesforce&#x20;Associate-Gross&#x20;Salary&#x20;Kes&#x20;45,000'>
                      <label for='Dropdown1_2'
                          class='zf-radioChoice'>Certified&#x20;Salesforce&#x20;Associate-Gross&#x20;Salary&#x20;Kes&#x20;45,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_3' name='Dropdown1'
                          checktype='c1'
                          value='Certified&#x20;Salesforce&#x20;Administrator-Gross&#x20;Salary&#x20;Kes&#x20;80,000'>
                      <label for='Dropdown1_3'
                          class='zf-radioChoice'>Certified&#x20;Salesforce&#x20;Administrator-Gross&#x20;Salary&#x20;Kes&#x20;80,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_4' name='Dropdown1'
                          checktype='c1'
                          value='Application&#x20;Support-Gross&#x20;Salary&#x20;Kes&#x20;30,000'>
                      <label for='Dropdown1_4'
                          class='zf-radioChoice'>Application&#x20;Support-Gross&#x20;Salary&#x20;Kes&#x20;30,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_5' name='Dropdown1'
                          checktype='c1'
                          value='Data&#x20;Entry-Gross&#x20;Salary&#x20;Kes&#x20;24,000'>
                      <label for='Dropdown1_5'
                          class='zf-radioChoice'>Data&#x20;Entry-Gross&#x20;Salary&#x20;Kes&#x20;24,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_6' name='Dropdown1'
                          checktype='c1'
                          value='Sales&#x20;and&#x20;Customer&#x20;Support-Gross&#x20;Salary&#x20;Kes&#x20;24,000'>
                      <label for='Dropdown1_6'
                          class='zf-radioChoice'>Sales&#x20;and&#x20;Customer&#x20;Support-Gross&#x20;Salary&#x20;Kes&#x20;24,000</label>
                  </span>
                  <span class='zf-multiAttType'>
                      <input class='zf-radioBtnType' type='radio' id='Dropdown1_7' name='Dropdown1'
                          checktype='c1'
                          value='Talent&#x20;Acquistion&#x20;Associate-Gross&#x20;Salary&#x20;Kes.&#x20;65,000'>
                      <label for='Dropdown1_7'
                          class='zf-radioChoice'>Talent&#x20;Acquistion&#x20;Associate-Gross&#x20;Salary&#x20;Kes.&#x20;65,000</label>
                  </span>
                  <div class='zf-clearBoth'></div>
              </div>
              <p id='Dropdown1_error' class='zf-errorMessage' style='display:none;'>Invalid value</p>
          </div>
          </div>

          <div class='field btns'>
            <button class='prev-1 prev'>Previous</button>
            <button class='next-1 next'>Next</button>
          </div>
        </div>

        <div class='page audiocontainer'>
          <div class='title'>Audio Interview: <span style='color:red'>*</span></div>
          <div class=''>
            <p>
            <div>
                <p style='box-sizing: border-box' class='text-format-content title'>
                  We are eager to learn more about you and your suitability for the position at our company. <br/>To assist us in our evaluation process, we kindly request that you provide a video clip 3 minutes in
                    total addressing the items below on <span style='box-sizing: border-box'><b
                        style='box-sizing: border-box; font-weight: bolder'>an accessible Google link.</b></span>&nbsp;<b
                      style='box-sizing: border-box; font-weight: bolder'>Paste the Google link of the video clip in the answer section below.</b>
                </p>

                <ul class='audio'>
                  <li>
                    <p>Please introduce yourself and tell us of your relevant experience and qualifications for the role in subject.</p>
                  </li>
                  <li>
                    <p>Please make sure to record your video in good lighting and in a quiet environment.Also please be audible.</p>
                    <p>If recording on your phone, make sure it's in landscape orientation.</p>
                  </li>
                  <li>
                    <p>Role-play the following script on the video.</p>
                  </li>
                <ul>
                      <br style='box-sizing: border-box'><i style='box-sizing: border-box'>
                      <p
                      style='box-sizing: border-box'><p style='box-sizing: border-box'>&quot;Hello, my name is
                        (…………………………..) <br style='box-sizing: border-box'> <br style='box-sizing: border-box'>I'm
                        calling to verify
                        employment information for George Castanza, as he recently
                        filled out a rental agreement.<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>(pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>I work for ACME systems;
                        we
                        do employment verifications on behalf of our customers.<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>(Pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>Yes, Can I speak with Jim
                        Johnson, as he is listed on my paperwork as George's
                        supervisor?<br style='box-sizing: border-box'> <br style='box-sizing: border-box'>(pause)<br
                          style='box-sizing: border-box'> <br style='box-sizing: border-box'>Yes, it would be fine to
                        speak with your HR staff. <br style='box-sizing: border-box'>
                        <br style='box-sizing: border-box'>(Pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>Hello, my name is
                        (employee
                        name) <br style='box-sizing: border-box'> <br style='box-sizing: border-box'>I'm calling to
                        verify
                        employment information for George Castanza, as he recently
                        filled out a rental agreement.<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>(Pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>Can you verify that
                        George
                        Castanza is currently employed there as Shift Supervisor?<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>(Pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>Thanks, can you also
                        verify
                        that George has worked there since 2018?<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>(pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>Can you also verify his
                        hourly or annual salary?<br style='box-sizing: border-box'>
                        <br style='box-sizing: border-box'>(pause)<br style='box-sizing: border-box'> <br
                          style='box-sizing: border-box'>I understand about not
                        giving
                        out salary information, Thank you very much for the
                        information.<br style='box-sizing: border-box'> <br style='box-sizing: border-box'>(pause)<br
                          style='box-sizing: border-box'> <br style='box-sizing: border-box'>Have a great day, <br
                          style='box-sizing: border-box'> <br style='box-sizing: border-box'></p></p></i><p
                    style='box-sizing: border-box'><p style='box-sizing: border-box'><i
                        style='box-sizing: border-box'>goodbye.&quot;</i><br
                        style='box-sizing: border-box'>
                        <br>
                    </p>
            </div>
            <div class='field audiolink'>
              <div class='label'>Google Link <span style='color:red'>*</span></div>
              <input type='text' name='SingleLine' checktype='c1' value='' maxlength='255' fieldType=1 placeholder='' />
            </div>
          </div>
          <div class='field btns'>
            <button class='prev-2 prev'>Previous</button>
            <button class='next-2 next'>Next</button>
          </div>
        </div>

        <div class='page'>
          <div class='title'>Resume and Certification: </div>
          <div class='field resum'>
            <div class=''>Your Updated Resume On an accessible Google link <span style='color:red'>*</span></div>
            <input type='text' name='SingleLine1' checktype='c1' value='' maxlength='255' fieldType=1 placeholder='' />
          </div>
          <div class='field resum'>
            <div class=''>Your English Proficiency Test Certificate (EFSET Certificate) on an accessible Google
              link. Paste the Google link of the certificate in the answer section below. <span style='color:red'>*</span></div>
            <input type='text' name='SingleLine2' checktype='c1' value='' maxlength='255' fieldType=1 placeholder='' />
          </div>
          <div class='field resum'>
            <div class=''>What can we do to make your application experience better.</div>
            <textarea type='text' name='MultiLine' maxlength='65535' placeholder='' style='padding-left:15px; border-radius:3px; border-color:#e6e8ea;'></textarea>
          </div>
          
          <div class='field btns'>
            <button class='prev-3 prev'>Previous</button>
            <button class='submit'>Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
";
    return $form;
}
?>