<!-- resources/views/partials/profile_popup.blade.php -->
<div id="profilePopup" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); padding:20px; background:#fff; border:1px solid #ccc; z-index:1000;">
    <button onclick="closePopup()">Close</button>
    <h3>User Profile</h3>
    <p><strong>Name:</strong> <span id="profileName"></span></p>
    <p><strong>Email:</strong> <span id="profileEmail"></span></p>
    <p><strong>Phone:</strong> <span id="profilePhone"></span></p>
    <p><strong>Address:</strong> <span id="profileAddress"></span></p>
    <p><strong>Created At:</strong> <span id="profileCreatedAt"></span></p>
</div>
<script>
    function openPopup() {
        fetch("{{ route('profile.data') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("profileName").textContent = data.name || "N/A";
                document.getElementById("profileEmail").textContent = data.email || "N/A";
                document.getElementById("profilePhone").textContent = data.phone || "N/A";
                document.getElementById("profileAddress").textContent = data.address || "N/A";
                const createdAt = data.created_at;
                if (createdAt) {
                    const date = new Date(createdAt);
                    const formattedDate = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true  // Set to true if you want 12-hour format
                    });
                    document.getElementById("profileCreatedAt").textContent = formattedDate;
                } else {
                    document.getElementById("profileCreatedAt").textContent = "N/A";
                }

                document.getElementById("profilePopup").style.display = "block";
            })
            .catch(error => console.error("Error fetching profile data:", error));
    }

    function closePopup() {
        document.getElementById("profilePopup").style.display = "none";
    }
</script>