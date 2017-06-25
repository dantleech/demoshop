
import * as React from 'react';
import { RouteComponentProps } from '@types/react-router';

export interface IProductParams {
    id: string
}

export const Product = (prop: RouteComponentProps<IProductParams>) => { 
    return <h1>product ({prop.match.params.id})</h1>;
}
