import { Injectable, CanActivate, ExecutionContext } from '@nestjs/common';
import { Reflector } from '@nestjs/core';

@Injectable()
export class AdminGuard implements CanActivate {
  constructor(private reflector: Reflector) {}
  async canActivate(context: ExecutionContext): Promise<boolean> {
    return true
    const request = context.switchToHttp().getRequest();
    if (!request.headers?.authorization) {
      return false;
    }
    const token = request.headers.authorization.split(' ')[1];
    const res = await fetch("http://php:9000/role-checker", {
      method: 'GET',
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log(res)
    if (res.status === 200) {
      return true;
    }
    return false;
  }
}
