document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const gridItems = document.querySelectorAll('.grid-item');
    const noImgFoundDiv = document.getElementById('no-img-found');

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const category = this.dataset.category;
            let imageFound = false;

            gridItems.forEach(item => {
                if (category === 'All' || item.dataset.category.toLowerCase() === category.toLowerCase()) {
                    item.style.display = 'block';
                    imageFound = true;
                } else {
                    item.style.display = 'none';
                }
            });

            if (!imageFound) {
                noImgFoundDiv.style.display = 'block';
            } else {
                noImgFoundDiv.style.display = 'none';
            }
        });
    });
});
