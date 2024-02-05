document.getElementById('send-donation').addEventListener('click', function () {
    var donationValue = document.getElementById('donation-amount').value;
    var postId = this.getAttribute('post-id');

    //interrupts execution if donationValue isn't a number
    if (isNaN(donationValue) || donationValue.trim() === "") {
        alert("The donation import must be a numeric value! ($)");
        return;
    }

    var donationform = new FormData();
    donationform.append('donationAmount', donationValue);
    donationform.append('postId', postId);

    console.log(donationform.get('donationAmount'), donationform.get('postId'));

    axios.post('./api/import-donation.php', donationform).then(response => {
        if (response.data["importDone"]) {
            setTimeout(() => document.location.reload(), 1000);
        } else {
            document.getElementById('res').innerText = response.data["error"];
        }
    });
});
