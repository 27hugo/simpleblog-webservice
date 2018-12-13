import { Component, OnInit } from '@angular/core';
import { StorageService } from 'src/app/services/storage.service';
import { Session } from 'src/app/models/Session.model';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  private session: Session;
  constructor(private storageService: StorageService) {

  }
  logout() {
    this.storageService.logout();
    location.reload();
  }
  ngOnInit() {
    this.session = this.storageService.getCurrentSession();
  }

}
