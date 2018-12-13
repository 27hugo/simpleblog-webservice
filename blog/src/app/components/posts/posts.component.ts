import { Component, OnInit } from '@angular/core';
import { PostsService } from 'src/app/services/posts.service';
import { Post } from 'src/app/models/Post.model';
import { NgForm } from '@angular/forms';
import { Session } from 'src/app/models/Session.model';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
  session: Session;
  posts: Post;
  constructor(private postsService: PostsService, private storageService: StorageService) {

  }

  addPost(post_data: NgForm) {
    const post: Post = post_data.value;
    post.post_posted_by = this.session.user.user_id;
    this.postsService.createPost(post).subscribe(data => console.log(data) );
  }
  deletePost(post_id) {
    this.postsService.deletePost(post_id).subscribe(data => console.log(data));
  }
  ngOnInit() {
    this.postsService.getPosts().subscribe(data => this.posts = data.body );
    this.session = this.storageService.getCurrentSession();
  }

}
