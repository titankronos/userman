<div class="span9">
  <form class="well form-horizontal" method="post" action="<?=site_url('admin/search')?>">
    <fieldset>
      <legend>Search for User</legend>
      <div class="control-group">
        <label class="control-label" for="search">Search</label>
        <div class="controls">
          <input type="text" name="search" />
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </fieldset>
  </form>
  <?php if(!empty($results)) : ?>
    <table class="table table-hover">
      <caption>Search Results</caption>
      <thead>
        <tr>
          <th>Username</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Delete?</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($results as $result) { ?>
          <tr>
            <td><a href="<?=site_url('admin/edit/'.$result['username'])?>"><?=$result['username']; ?></a></td>
            <td><?=$result['first_name']; ?></td>
            <td><?=$result['last_name']; ?></td>
            <td><button class="btn btn-danger">Remove User</button></td>
          </tr>
      <?php } ?>
      </tbody>
    </table>
  <?php endif; ?>
</div><!--/span-->
</div><!--/row-->

