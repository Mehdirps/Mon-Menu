  <section class="dashboard-section">
       </div>
      <div class="container-fluid pt-1" id="restaurants">
        <h2>Les Restaurants</h2>
        <hr>
        <div class="table-responsive small">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Infos</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>


             @foreach($restaurants as $restaurant)
             <tr>
              <td>{{$restaurant->id}}</td>
              <td>{{$restaurant->name}}</td>
              <td><div style="max-width: 80px">{{$restaurant->address}}</div></td>
              <td></td>
              <td>
                <?= $edit ?>
                <a href="?restaurant=restaurant-{{$restaurant->id}}"><?php echo $see; ?>
                  </a>
                <?php echo $trash; ?>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>