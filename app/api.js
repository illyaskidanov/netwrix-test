import axios from 'axios';

const axiosClient = axios.create({
    baseURL: 'http://localhost',
    responseType: 'json',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export default axiosClient;