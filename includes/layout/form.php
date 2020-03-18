<div class="fields">
  <div class="field">
    <label for="name">Name:</label>
    <input type="text" placeholder="Name Contact" id="name" value="<?php echo ($contact['name']) ? $contact['name'] : '';  ?>">
  </div>
  <div class="field">
    <label for="business">Business:</label>
    <input type="text" placeholder="Name Business" id="business" value="<?php echo ($contact['business']) ? $contact['business'] : '';  ?>">
  </div>
  <div class="field">
    <label for="phone">Phone:</label>
    <input type="tel" placeholder="Phone Contact" id="phone" value="<?php echo ($contact['phone']) ? $contact['phone'] : '';  ?>">
  </div>
</div>

<div class="field send">
  <?php
  $textBtn = ($contact['phone']) ? 'Save' : 'Add';
  $action = ($contact['phone']) ? 'update' : 'create';
  ?>
  <input type="hidden" id="action" value="<?php echo $action; ?>">
  <?php if (isset($contact['id'])) { ?>
    <input type="hidden" id="id" value="<?php echo $contact['id']; ?>">
  <?php } ?>
  <input type="submit" value="<?php echo $textBtn; ?>">
</div>