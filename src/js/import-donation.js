document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('send-donation').addEventListener('click', async function () {
        var donationValue = document.getElementById('donation-amount').value;
        var postId = this.getAttribute('post-id');
        var reciver = this.getAttribute('owner-id');


        //interrupts execution if donationValue isn't a number
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
            setTimeout(() => document.location.reload(), 1000);
            var notFrom = new FormData();
            notFrom.append("not_type",'Donation');
            notFrom.append("receiver",reciver);
            notFrom.append("post_id",postId);

            axios.post('./api/insertNotification.php', notFrom);
        } else {
            document.getElementById('errorMessage').textContent = "The donation must be a number!";
        }
        
    });
});
