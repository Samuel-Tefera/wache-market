let popupType = null;

function switchMode(mode) {
  const modeDisplay = document.getElementById("user-mode-display");
  modeDisplay.textContent = mode.charAt(0).toUpperCase() + mode.slice(1);
}

function openPopup(type) {
  const popup = document.getElementById("popup");
  const title = document.getElementById("popup-title");
  popup.style.display = "flex";
  popup.dataset.actionType = type;

  // Clear previous input values
  document.getElementById("transaction-form").reset();
  title.textContent = type.charAt(0).toUpperCase() + type.slice(1);
}

function closePopup() {
  const popup = document.getElementById("popup");
  popup.style.display = "none";
  popup.dataset.actionType = "";
  document.getElementById("transaction-form").reset();
}

// Make sure this only attaches once
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("transaction-form");
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const popup = document.getElementById("popup");
    const type = popup.dataset.actionType;
    const method = document.getElementById("method").value;
    const amount = parseFloat(document.getElementById("amount").value);

    if (!method || isNaN(amount) || amount <= 0) {
      alert("Please enter valid method and amount.");
      return;
    }

    // Handle logic
    alert(`${type.toUpperCase()} of $${amount} via ${method.toUpperCase()} submitted!`);

    closePopup();
  });
});



function toggleWalletVisibility() {
  const wallet = document.getElementById("wallet-amount");
  const toggleBtn = document.querySelector(".eye-toggle");

  if (wallet.textContent === "****") {
    wallet.textContent = `$${currentWalletAmount}`;
    toggleBtn.textContent = "👁️";
  } else {
    currentWalletAmount = parseFloat(wallet.textContent.replace(/\$/g, ""));
    wallet.textContent = "****";
    toggleBtn.textContent = "🙈";
  }
}
