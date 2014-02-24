<div class="span9">
<p>Please update your infomation below. All fields are required except for cell number.</p>
<?php if(validation_errors()) : ?>
<div class="alert">
  <a class="close" data-dismiss="alert">×</a>
  <?=validation_errors()?>
</div>
<?php endif; ?>
  <form class="well form-horizontal" method="post" action="<?=site_url('user/process')?>">
    <fieldset>
      <legend>Personal Infomation</legend>
      <div class="control-group">
        <label class="control-label" for="username">User Name</label>
        <div class="controls">
          <input type="text" readonly="true" name="username" value="<?=$this->session->userdata('username')?>" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="first_name">First Name</label>
        <div class="controls">
          <input type="text" readonly="true" name="first_name" value="<?=set_value('first_name')?>" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="last_name">Last Name</label>
        <div class="controls">
          <input type="text" readonly="true" name="last_name" value="<?=set_value('last_name')?>" />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="phone">Cell Number</label>
        <div class="controls">
          <input type="text" name="phone" value="<?=set_value('phone')?>" placeholder="(XXX) XXX-XXXX" />
        </div>
      </div>
      <fieldset>
        <legend>Current Address</legend>
        <div class="control-group">
          <label class="control-label" for="cur_street">Street</label>
          <div class="controls">
            <input type="text" name="cur_street" value="<?=set_value('cur_street')?>" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cur_city">City</label>
          <div class="controls">
            <input type="text" name="cur_city" value="<?=set_value('cur_city')?>" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cur_state">State</label>
          <div class="controls">
            <select id="cur_state" name="cur_state">
              <?php if(set_value('cur_state')) : ?>
                <option value="<?=set_value('cur_state')?>"><?=set_value('cur_state')?></option>
              <?php else : ?>
                <option value="None">None</option>
              <?php endif; ?>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">Dist of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cur_zip">Zip</label>
          <div class="controls">
            <input type="text" name="cur_zip" value="<?=set_value('cur_zip')?>" />
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <label class="checkbox">
              <input type="checkbox" id="copy_address" />
              My current and permanent addresses are the same
            </label>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>Permanent Address</legend>
        <div class="control-group">
          <label class="control-label" for="perm_street">Street</label>
          <div class="controls">
            <input type="text" name="perm_street" value="<?=set_value('perm_street')?>" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="perm_city">City</label>
          <div class="controls">
            <input type="text" name="perm_city" value="<?=set_value('perm_city')?>" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="perm_state">State</label>
          <div class="controls">
            <select id="perm_state" name="perm_state">
              <?php if(set_value('perm_state')) : ?>
                <option value="<?=set_value('perm_state')?>"><?=set_value('perm_state')?></option>
              <?php else : ?>
                <option value="None">None</option>
              <?php endif; ?>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">Dist of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="perm_zip">Zip</label>
          <div class="controls">
            <input type="text" name="perm_zip" value="<?=set_value('perm_zip')?>" />
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>Password</legend>
        <p>Leave blank to not change</p>
        <div class="control-group">
          <label class="control-label" for="cur_password">Current Password</label>
          <div class="controls">
            <input type="password" name="cur_password" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="password1">Password</label>
          <div class="controls">
            <input type="password" name="password1" />
          </div>
          <label class="control-label" for="password2">Confirm Password</label>
          <div class="controls">
            <input type="password" name="password2" />
          </div>
        </div>
      </fieldset>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn">Cancel</button>
      </div>
    </fieldset>
  </form>
</div><!--/span-->
</div><!--/row-->
