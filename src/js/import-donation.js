document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('send-donation')
    
    if (btn != null) {
        btn.addEventListener('click', async function () {
            var donationValue = document.getElementById('donation-amount').value;
            var postId = this.getAttribute('data-post-id');
            var reciver = this.getAttribute('data-owner-id');


            if (isNaN(donationValue) || donationValue.trim() === "") {
                document.getElementById('errorMessage').textContent = "The donation must be a number!";
                return;
            }

            var donationform = new FormData();
            donationform.append('donationAmount', donationValue);
            donationform.append('postId', postId);
            donationform.append('reciver',reciver);

            var response = await axios.post('./api/import-donation.php', donationform)
            if (response.data["importDone"]) {
                setTimeout(() => document.location.reload(), 100);
                var notFrom = new FormData();
                notFrom.append("not_type",'Donation');
                notFrom.append("receiver",reciver);
                notFrom.append("post_id",postId);

                axios.post('./api/insert-notification.php', notFrom);
            } else {
                document.getElementById('errorMessage').textContent = response.data["error"];
            }
            
        });
    }
});
