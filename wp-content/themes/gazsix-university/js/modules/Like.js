import $ from 'jquery';
class Like {

    constructor() {
        // alert('testing from Like.js');
        this.events(); //with this our events gets added as soon as the page loads

    }

    events() {
        $(".like-box").on('click', this.ourClickDispatcher.bind(this));
    }

    //methods
    ourClickDispatcher(e) { //our eventhandler above passes along info on which element got clicked; we pass e in case we have multiple like boxes or professors on a single page, therefore we need target an element with a class different from like-box
        var currentLikeBox = $(e.target).closest(".like-box"); //e.target means whatever element got clicked on; closest looks for closest ancester(parent/grandparent) no matter if click on i element, like box grey box, heart icon, etc
        if(currentLikeBox.data('exists')== 'yes') {
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox); //we need to pass currentlikebox if we want toaccess data-professor in this function
        }
    }
    createLike(currentLikeBox) {
        // alert("createLike message");
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST', //regarding professorId below, in order to assign it dynamically, we need to assign a data attribute in html(data-professor) and then access it via js
            data: {'professorId': currentLikeBox.data('professor')}, //we use data property to send along info to server side and we could add it to the end of url above like ...manageLike?professorId=789, but this way is cleaner
            success: (response)=>{
                console.log(response);
            },
            error: (response)=>{
                console.log(response);
            },
        });
    }
    deleteLike(currentLikeBox) {
        // alert("deleteLike message");
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            success: (response)=>{
                console.log(response);
            },
            error: (response)=>{
                console.log(response);
            },
        });
    }

}

export default Like;