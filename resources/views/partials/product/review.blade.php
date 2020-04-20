<div class="container p-0 mb-5 d-none d-md-block">
  <div class="row">
    <div class="col-4 d-flex flex-row justify-content-center">
      <div class="d-flex flex-column align-items-center">
        <img src="{{ asset('/storage/img_user/' . $review->user->profilePicture->link) }}" alt="" style="max-width: 100px">
        <h6>{{ $review->user->name }}</h6>
      </div>
      <div class="d-flex flex-column align-items-center justify-content-start px-3 border-right border-dark">
        <div class="d-flex flex-row align-items-center py-2">
          {{ $review->score }}/5 <i class="fas fa-star"></i>
        </div>
        {{ date("F jS Y", strtotime($review->date)) }}
        <a href="" class="py-2 text-center a_link">Report Review</a>
      </div>
    </div>
    <div class="col-8">
      <h4>{{ $review->title }}</h4>
      <p>{{ $review->body }}</p>      
    </div>
  </div>
</div>

<div class="d-flex flex-column justify-content-center p-0 pb-2 mb-5 d-md-none border-bottom border-dark">
  <div class="container-fluid d-flex flex-row justify-content-center">
    <div class="row">
      <div class="col-6 d-flex flex-column align-items-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTn9doOawyILir4RkSAH7LpWutreyCG1FlG4Vak3xamlUCkcG9L" alt="" style="max-width: 100px">
        <h5>Name</h5>
      </div>
      <div class="col-6 d-flex flex-column align-items-center justify-content-center px-3">
        <div class="d-flex flex-row align-items-center py-2">
          4/5 <i class="fas fa-star"></i>
        </div>
        12/05/2019
        <a href="" class="py-2 text-center a_link">Report Review</a>
      </div>
    </div>
  </div>
  <div class="">
    <h4>Header</h4>
    <p>Praesent vitae urna et odio ullamcorper finibus. Nunc dictum malesuada velit, eu molestie ligula. Phasellus ante diam, tempus sed lobortis eu, sollicitudin vel orci. Morbi interdum aliquam bibendum. Sed dapibus risus sit amet viverra aliquam. Suspendisse aliquam odio porttitor sem bibendum, a tempor massa pretium. Etiam eget accumsan magna. Donec euismod neque et metus aliquet sodales. Pellentesque sed enim ut elit maximus fringilla.</p>
    <p>In a pretium mi. Nam mattis laoreet arcu, sit amet bibendum orci mollis vel. Vestibulum pulvinar enim tortor, et fringilla est aliquam in. Fusce nec nulla consequat, rhoncus nisi et, pellentesque sapien. Praesent pulvinar ut lorem eu tristique. Vivamus sit amet lacus sed ante finibus consequat. Donec ac fringilla lectus. Mauris facilisis erat velit, et suscipit eros egestas eget. Vestibulum vel orci in lacus sollicitudin posuere. Maecenas quis congue leo. Nullam ultricies, odio a vehicula sollicitudin, augue nunc commodo libero, vel feugiat tellus lorem non purus. Nam ultricies consectetur purus, vel varius leo viverra eget. </p>
  </div>
</div>