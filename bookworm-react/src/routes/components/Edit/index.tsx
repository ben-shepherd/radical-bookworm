import ReturnToLink from 'components/ReturnToLink';
import StarRating from 'components/StarRating';
import StylizedTextField from 'components/StylisedTextfield';
import UpdateButton from "../../../components/UpdateButton";
import {useParams} from 'react-router-dom';
import Content from '../../../components/theme/Content';
import './styles.scss';
import useBookById from "../../../hooks/Books/useBookById";
import {useEffect, useRef, useState} from "react";
import {Book} from "../../../types/books.t";
import {enqueueSnackbar} from "notistack";
import useUpdateBook from "../../../hooks/Books/useUpdateBook";

const Edit = () => {

    const {id = null} = useParams();

    const {book, setBook, refresh, loading} = useBookById();
    const {updateBook, updating} = useUpdateBook()

    // Used for waiting for input changes
    const timeoutHandle = useRef<ReturnType<typeof setTimeout> | null>(null)

    const getPrettyPrice = (price?: number | null): string => `${price ?? 0} GBP`;
    const [showPrettyPrice, setShowPrettyPrice] = useState<boolean>(true);
    const [prettyPrice, setPrettyPrice] = useState<string | null>(null);


    const removeNonDigit = (value: string) => {
        return value.replace(/[^\d\.]/g, '');
    }

    /**
     * Page loaded, update requested book by its ID.
     */
    useEffect(() => {
        if (id) {
            refresh({id}).then((fetchedBook) => {

                // Newly loaded book should show the pretty price
                setShowPrettyPrice(true)
                setPrettyPrice(getPrettyPrice(fetchedBook?.price ?? 0))
            });
        }

        return () => {
            if (timeoutHandle.current) {
                clearTimeout(timeoutHandle.current);
            }
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    /**
     * Apply changes to the book
     */
    const handleChange = (key: string, value: unknown, instantUpdate: boolean = false) => {
        const waitMS = instantUpdate ? 0 : 1500

        setBook({...book, [key]: value} as Book);

        if (timeoutHandle.current) {
            clearTimeout(timeoutHandle.current);
        }

        timeoutHandle.current = setTimeout(async () => {

            if (!book?._id) return;

            const response = await updateBook(book._id, {[key]: value});

            if (response.ok) {
                setShowPrettyPrice(true)
                setPrettyPrice(getPrettyPrice(response.json.price))
                enqueueSnackbar({message: `The ${key} has been updated!`, variant: 'success'});
            }
        }, waitMS)
    }

    const handleUpdate = async () => {
        if (!book?._id) return;

        const response = await updateBook(book._id, {
            rating: book?.rating ?? 0,
            price: parseFloat(removeNonDigit((book?.price ?? '0').toString()))
        });

        if (response.ok) {
            setShowPrettyPrice(true)
            setPrettyPrice(getPrettyPrice(response.json.price))
            enqueueSnackbar({message: `Successfully updated!`, variant: 'success'});
        }
    }

    return (
        <Content id='favourite-selected'>

            <div className="my-10"></div>

            <div className='banner'>
                <div className='summary'>
                    <div className='title'>
                        <p>{book?.title}</p>
                    </div>
                    <div className="author">
                        <p>{loading ? '' : 'by'} <span className="capitalize">{book?.authors[0]}</span></p>
                    </div>
                </div>
                <div className="image-darker"></div>
                <div className='image' style={{backgroundImage: `url(${book?.image})`}}></div>
            </div>

            <div className="my-10"></div>

            <h1 className='heading-1'>Edit</h1>

            <div className="my-10"></div>

            <StylizedTextField
                label='Cost'
                value={showPrettyPrice && prettyPrice ? prettyPrice : (book?.price ?? 0).toString()}
                onChange={(value) => {
                    setPrettyPrice(null);
                    handleChange('price', removeNonDigit(value));
                }}
                onFocus={() => setShowPrettyPrice(false)}
            />

            <div className="my-10"></div>

            <StylizedTextField
                label='Rating'
                EditComponent={(
                    <StarRating rating={book?.rating ?? 0}
                                onClick={(value: number) => handleChange('rating', value, true)}/>
                )}
            />

            <UpdateButton onClick={handleUpdate} disabled={updating || loading} className={'my-10'}
                          text={updating ? 'Updating...' : 'Update'}/>

            <ReturnToLink url='/favourites' text='Favourites'/>

        </Content>
    )
}

export default Edit