export const delLocalStorageKey = (key) =>  {
    localStorage.removeItem('key')
};
export const setLocalStorageKey = (key, data) =>  {
    localStorage.setItem(key, JSON.stringify(data));
};
export const getLocalStorageKey = (key) =>  {
    let data = [];
    try
    {
        data = JSON.parse(localStorage.getItem(key));
    }
    catch (e)
    {

    }

    return data;
};