<div class="container mt-3">
   <h1>Search Results</h1>
   <?php if (empty($data['results'])) : ?>
      <p>No results found.</p>
   <?php else : ?>
      <ul class="list-group">
         <?php foreach ($data['results'] as $result) : ?>
            <li class="list-group-item">
               <?= ucfirst($result['type']) ?>: <?= $result['name'] ?> (Distance: <?= $result['distance'] ?>)
            </li>
         <?php endforeach; ?>
      </ul>
   <?php endif; ?>
</div>