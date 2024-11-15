<?php


  // Query to get all data for the authenticated user
  $sql = "SELECT * FROM tbl_betting WHERE userid = '$userid'";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) > 0):
  ?>
      <table>
          <tr>
              <th>Period ID</th>
              <th>Value</th>
              <th>Number</th>
              <th>Amount</th>
              <th>Number Amount</th>
          </tr>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                  <td><?= htmlspecialchars($row['periodid']) ?></td>
                  <td><?= htmlspecialchars($row['value']) ?></td>
                  <td><?= htmlspecialchars($row['number']) ?></td>
                  <td><?= htmlspecialchars($row['amount']) ?></td>
                  <td><?= htmlspecialchars($row['numberammount']) ?></td>
              </tr>
          <?php endwhile; ?>
      </table>
  <?php else: ?>
      <p>No data found for the authenticated user.</p>
  <?php
  endif;
?>