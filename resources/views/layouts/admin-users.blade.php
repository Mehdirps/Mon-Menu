 <h3>Les Utilisateurs</h3>
    <hr>
    <div class="table-responsive small">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Users</th>
            <th scope="col">Restaurant</th>
            <th scope="col">Réf. Client</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->restaurant->name}}</td>
            <td>{{$user->ref_client}}</td>
            <td>
              <?= $edit ?>
              <?php echo $see; ?>
              <?php echo $trash; ?>
            </td>
          </tr>
          @endforeach


        </tbody>
      </table>