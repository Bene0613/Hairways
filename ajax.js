document.querySelector("#commentForm").addEventListener("click", function(e){
    e.preventDefault();
    let text = document.querySelector("#reviewText").value;
    let productId = document.querySelector("#prdInfo").dataset.productId;

    let formData= new FormData();
    formData.append("text", text);
    formData.append("productId", productId);

    fetch("ajax/saveReview.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if(result.image === 'Review added successfully') {
            let reviewItem = document.createElement('div');
            reviewItem.classList.add('review');
            reviewItem.innerHTML = `
            <div class="header">
                <h3 class="username">${result.user}</h3>
                <span class="time">${result.date}</span>
            </div>
            <div class='comment'>
                <p>${result.body}</p>
            </div>
            `;

            document.querySelector("#reviewList").append(reviewItem);
            document.querySelector("#reviewText").value = '';
        } else {
            alert('Error adding review');
        }
    })
    .catch(error =>{
        console.error("Error", error);
    });
});
