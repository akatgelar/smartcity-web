import Swal from 'sweetalert2'
import VueJwtDecode from 'vue-jwt-decode';
import { useRouter } from 'vue-router';
import { AppSession } from '../interfaces/SessionModel';

export function checkSession() {
    const router = useRouter();

    // console.log(localStorage);
    if (localStorage.length > 0) {
        // console.log('ada session')
        if (localStorage.getItem('token') != null) {
            // console.log('ada session token')
            const token = localStorage.getItem('token')
            const tokenDecoded = VueJwtDecode.decode(token);
            const exp = tokenDecoded['exp']
            const milliseconds = exp * 1000;
            const date = new Date(milliseconds);
            if(date > new Date()) {
                // pass
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Session expired!',
                }).then((result) => {
                    router.push('/auth');
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                text: 'Session token not found!',
            }).then((result) => {
                router.push('/auth');
            });
        }
    } else {
        Swal.fire({
            icon: 'error',
            text: 'Session not found!',
        }).then((result) => {
            router.push('/auth');
        });
    }
}

export function getSession() : AppSession {
    if (localStorage.length > 0) {
        return {
            username: localStorage.getItem('username'),
            name: localStorage.getItem('name'),
            email: localStorage.getItem('email'),
            user_level_id: localStorage.getItem('user_level_id'),
            user_level_name: localStorage.getItem('user_level_name'),
            picture: localStorage.getItem('picture'),
            token: localStorage.getItem('token'),
        };
    } else {
        return {
            username: '',
            name: '',
            email: '',
            user_level_id: '',
            user_level_name: '',
            picture: '',
            token: '',
        };
    }
}
