document.addEventListener( "DOMContentLoaded", async function () {
  await fetchProfileData();
  toggleWalletVisibility();
  const form = document.getElementById("transaction-form");
  form.addEventListener( "submit", async function ( e ) {
    e.preventDefault();

    const popup = document.getElementById("popup");
    const type = popup.dataset.actionType;

    const formData = new FormData( form );
    formData.append( 'action', type );
    console.log(formData);

    const method = document.getElementById("method").value;
    const amount = parseFloat(document.getElementById("amount").value);

    if (!method || isNaN(amount) || amount <= 0) {
      alert("Please enter valid method and amount.");
      return;
    }

    // Handle logic
    const response = await fetch( '../core/transaction.php', {
      method: 'POST',
      body: formData
    } );
    const data = await response.json();
    console.log(data);

    if ( data.success ) {
        alert(`${type.toUpperCase()} of $${amount} via ${method.toUpperCase()} submitted!`);
    } else {
      alert(data.message)
    }

    closePopup();
  });
} );

async function fetchProfileData () {
  const response = await fetch( '../core/profile.php' );
  const data = await response.json();

  if ( data.success ) {
    renderUserProfile( data.user );
    renderUserTransactions(data.transactions);
  }else {
    alert('Failed to load profile: ' + data.message);
    window.location.href = '/login.php';
  }
};

function renderUserProfile ( user ) {
  document.getElementById( 'user-image' ).src = '../' + user.profile_link_url;
  document.getElementById( 'user-name' ).textContent = user.first_name + ' ' + user.last_name;
  document.getElementById( 'user-email' ).textContent = user.email;
  document.getElementById( 'user-phone' ).textContent = user.phone_number;
  document.getElementById( 'user-address' ).textContent = user.address;
  document.getElementById( 'wallet-amount' ).textContent = user.wallet_balance;
  document.getElementById( 'user-mode-display' ).textContent =  capitalizeFirstLetter(user.current_mode);

  const buyerRadio = document.querySelector('input[name="userMode"][value="buyer"]');
  const sellerRadio = document.querySelector('input[name="userMode"][value="seller"]');

  if (user.current_mode === 'buyer') {
      buyerRadio.checked = true;
  } else if (user.current_mode === 'seller') {
      sellerRadio.checked = true;
  }
};

function renderUserTransactions(transactions) {
  const transactionsContainer = document.querySelector( '.transactions' );

  if (transactions.length === 0) {
      transactionsContainer.innerHTML = '<p>No recent transactions found.</p>';
      return;
  }

  transactions.forEach(txn => {
      const txnDiv = document.createElement('div');
      txnDiv.classList.add('transaction');

      if (txn.type.toLowerCase() === 'sale' || txn.type.toLowerCase() === 'deposit' || txn.type.toLowerCase() === 'refund') {
          txnDiv.classList.add('positive');
      } else {
          txnDiv.classList.add('negative');
      }

      txnDiv.innerHTML = `
          <p><strong>${txn.type.toLowerCase() === 'sale' || txn.type.toLowerCase() === 'deposit' || txn.type.toLowerCase() === 'refund' ? '+' : '-'} $${parseFloat(txn.amount).toFixed(2)}</strong> - ${capitalizeFirstLetter(txn.type)} - ${txn.method === 'cbe' ? txn.method.toUpperCase() : capitalizeFirstLetter(txn.method)}</p>
          <p class="date">${formatDate(txn.transaction_date)}</p>
      `;

      transactionsContainer.appendChild(txnDiv);
  });
}

function capitalizeFirstLetter(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
};


function formatDate(dateString) {
  const date = new Date(dateString);
  const now = new Date();

  const isToday = date.toDateString() === now.toDateString();

  if (isToday) {
      const diffMs = now - date;
      const diffMinutes = Math.floor(diffMs / 60000);

      if (diffMinutes < 1) {
          return 'Just now';
      } else if (diffMinutes < 60) {
          return `${diffMinutes} minutes ago`;
      } else {
          const diffHours = Math.floor(diffMinutes / 60);
          return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
      }
  } else {
      return date.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'short',
          day: '2-digit'
      });
  }
}


let popupType = null;

async function switchMode(mode) {
  const modeDisplay = document.getElementById("user-mode-display");
  modeDisplay.textContent = mode.charAt(0).toUpperCase() + mode.slice(1);

  try {
    const formData = new FormData();
    formData.append("mode", mode);

    const response = await fetch("../core/switch-mode.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();

    if (response.ok) {
      alert(`Mode switched to ${result.new_mode.toUpperCase()}`);
    } else {
      alert(result.error || "Something went wrong");
    }
    window.location.reload();
  } catch (error) {
    alert("Network error while switching mode");
    window.location.reload();
  }
}


function openPopup(type) {
  const popup = document.getElementById("popup");
  const title = document.getElementById("popup-title");
  popup.style.display = "flex";
  popup.dataset.actionType = type;

  document.getElementById("transaction-form").reset();
  title.textContent = type.charAt(0).toUpperCase() + type.slice(1);
}

function closePopup() {
  const popup = document.getElementById("popup");
  popup.style.display = "none";
  popup.dataset.actionType = "";
  document.getElementById("transaction-form").reset();
}


function toggleWalletVisibility() {
  const wallet = document.getElementById("wallet-amount");
  const toggleBtn = document.querySelector( ".eye-toggle" );

  if (wallet.textContent === "****") {
    wallet.textContent = `$${currentWalletAmount}`;
    toggleBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>`;
  } else {
    currentWalletAmount = parseFloat(wallet.textContent.replace(/\$/g, ""));
    wallet.textContent = "****";
    toggleBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>`;
  }
}

const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navCenter = document.querySelector('.seller-nav-center');

if (mobileMenuBtn && navCenter) {
    mobileMenuBtn.addEventListener('click', () => {
        navCenter.classList.toggle('active');
        mobileMenuBtn.innerHTML = navCenter.classList.contains('active')
            ? '<i class="fas fa-times"></i>'
            : '<i class="fas fa-bars"></i>';
    });
}