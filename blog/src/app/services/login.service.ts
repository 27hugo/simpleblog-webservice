import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Session } from '../models/Session.model';

@Injectable()
export class LoginService {
  private httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };
  private usersUrl = 'http://localhost/blog/api-blog/index.php/users/';

  constructor(private http: HttpClient) {

  }
  loginUser(login_data): Observable<Session> {
    return this.http.post<Session>(this.usersUrl + 'validate', login_data, this.httpOptions);
  }
}
