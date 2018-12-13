import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Post } from '../models/Post.model';
import { Observable } from 'rxjs';

@Injectable()
export class PostsService {
  private httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };
  postsUrl = 'http://localhost/blog/api-blog/index.php/posts/';
  constructor(private http: HttpClient) {

  }
  getPosts(): Observable<HttpResponse<Post>> {
    return this.http.get<Post>(
      this.postsUrl, {observe: 'response'}
      );
  }
  getPostById(post_id) {
    return this.http.get(this.postsUrl + post_id);
  }
  createPost(post_data) {
    return this.http.post(this.postsUrl , post_data , this.httpOptions);
  }
  updatePost() {

  }
  deletePost(post_id) {
    return this.http.delete(this.postsUrl + post_id, this.httpOptions);
  }
}
