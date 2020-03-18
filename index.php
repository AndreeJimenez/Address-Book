<?php
include 'includes/functions/functions.php';
include 'includes/layout/header.php';
?>

<div class="container-bar">
  <h1>Address Book</h1>
</div>

<div class="bg-secundary container shadow">
  <form id="contact" action="#">
    <legend>Add Contact <span>All fields are required</span> </legend>

    <?php include 'includes/layout/form.php'; ?>
  </form>
</div>

<div class="bg-white container shadow contacts">
  <div class="container-contacts">
    <h2>Contacts</h2>

    <input type="text" id="search" class="searcher shadow" placeholder="Search Contacts...">

    <p class="total-contacts"><span></span> Contacts</p>

    <div class="container-table">
      <table id="list-contacts" class="list-contacts">
        <thead>
          <tr>
            <th>Name</th>
            <th>Business</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php $contacts = getContacts();

          if ($contacts->num_rows) {

            foreach ($contacts as $contact) { ?>
              <tr>

                <td><?php echo $contact['name']; ?></td>
                <td><?php echo $contact['business']; ?></td>
                <td><?php echo $contact['phone']; ?></td>
                <td>
                  <a class="btn-update btn" href="update.php?id=<?php echo $contact['id']; ?>">
                    <i class="fas fa-pen-square"></i>
                  </a>
                  <button data-id="<?php echo $contact['id']; ?>" type="button" class="btn-delete btn">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include 'includes/layout/footer.php'; ?>