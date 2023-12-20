// Array to hold added dishes
$dishes = isset($dishes) ? $dishes : [];

// Function to render inputted dishes in a table
function renderInputtedDishes() {
  const inputtedDishesTable = document.getElementById('menuItems');
  inputtedDishesTable.innerHTML = '';

  dishes.forEach((dish, index) => {
    const row = document.createElement('tr');

    const nameCell = document.createElement('td');
    nameCell.textContent = dish.name;

    const priceCell = document.createElement('td');
    priceCell.textContent = `₱${dish.price}`;

    const descriptionCell = document.createElement('td');
    descriptionCell.textContent = dish.description;

    const categoryCell = document.createElement('td');
    categoryCell.textContent = dish.category;

    const imageCell = document.createElement('td');
    const imageUrl = document.createElement('span');
    imageUrl.textContent = dish.image; // Displaying the image URL
    imageCell.appendChild(imageUrl);

    const actionCell = document.createElement('td');
    const editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.classList.add('btn', 'btn-primary', 'mr-2');
    editButton.addEventListener('click', () => handleEdit(index));

    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.classList.add('btn', 'btn-danger');
    removeButton.addEventListener('click', () => handleRemove(index));

    actionCell.appendChild(editButton);
    actionCell.appendChild(removeButton);

    row.appendChild(nameCell);
    row.appendChild(priceCell);
    row.appendChild(descriptionCell);
    row.appendChild(categoryCell);
    row.appendChild(imageCell);
    row.appendChild(actionCell);

    inputtedDishesTable.appendChild(row);
  });
}

// Function to handle the remove action for a specific dish
function handleRemove(index) {
  dishes.splice(index, 1);
  renderInputtedDishes();
}

// Function to handle the edit action for a specific dish
function handleEdit(index) {
  const dishToEdit = dishes[index];
  document.getElementById('name').value = dishToEdit.name;
  document.getElementById('price').value = dishToEdit.price;
  document.getElementById('description').value = dishToEdit.description;
  document.getElementById('category').value = dishToEdit.category;

  const addButton = document.querySelector('button[type="submit"]');
  addButton.textContent = 'Update';
  addButton.onclick = function () {
    handleUpdate(index);
  };
}

// Function to handle the update action for a specific dish
function handleUpdate(index) {
  const newName = document.getElementById('name').value;
  const newPrice = document.getElementById('price').value;
  const newDescription = document.getElementById('description').value;
  const newCategory = document.getElementById('category').value;

  if (newName && newPrice && newDescription && newCategory) {
    dishes[index].name = newName;
    dishes[index].price = newPrice;
    dishes[index].description = newDescription;
    dishes[index].category = newCategory;

    renderInputtedDishes();

    const submitButton = document.querySelector('button[type="submit"]');
    submitButton.textContent = 'Submit';
    submitButton.onclick = function (event) {
      event.preventDefault();
      handleAddDish();
    };

    document.getElementById('addDishForm').reset();
  } else {
    alert('Please fill in all fields.');
  }
}

// Function to handle the addition of a new dish
function handleAddDish() {
  const name = document.getElementById('name').value;
  const price = document.getElementById('price').value;
  const description = document.getElementById('description').value;
  const category = document.getElementById('category').value;
  const image = document.getElementById('image').value;

  if (name && price && description && category && image) {
    const newDish = {
      name,
      price,
      description,
      category,
      image,
    };

    // Save dish to the database
    saveDishToDatabase(newDish);

    // Add the dish to the array for rendering
    dishes.push(newDish);
    renderInputtedDishes();
    document.getElementById('addDishForm').reset();
  } else {
    alert('Please fill in all fields.');
  }
}

// Function to save the dish to the database
function saveDishToDatabase(dish) {
  // Use AJAX to send the dish data to a PHP script
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'saveDish.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log('Dish saved successfully');
    } else {
      console.error('Failed to save dish');
    }
  };
  xhr.send(JSON.stringify(dish));
}

// Add dish form submission event
document.getElementById('addDishForm').addEventListener('submit', function (event) {
  event.preventDefault();
  handleAddDish();
});

// Initial rendering of menu items
renderInputtedDishes();
